<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\User;
use App\Professor;
use App\Turma;
use App\Nucleo;
use App\Pessoa;
use Illuminate\Support\Facades\Session;

class professorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Funções ferramentas
    public function filtrar_ano($professoresnalista, $anofiltro, $option){
        $professoresfiltrados = [];
        foreach($professoresnalista as $professornalista){
            list($dia, $mes, $ano) = explode('/', $professornalista['nascimento']);
            $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);
            $idade = (int)floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
            if($option == 1){
                if($idade >= $anofiltro){
                    array_push($professoresfiltrados, $professornalista);
                }
                if($dia.'/'.$mes == '29/02' && (date('Y')/4 == 0 && date('Y')/100 != 0)){
                    array_pust($professoresfiltradas, $professornalista);
                }
            }
            else{
                if($idade <= $anofiltro){
                    array_push($professoresfiltrados, $professornalista);
                }
                if($dia.'/'.$mes == '29/02' && (date('Y')/4 == 0 && date('Y')/100 != 0)){
                    array_pust($professoresfiltrados, $professornalista);
                }
            }
        }

        return $professoresfiltrados;
    }

    //Funções de Redirecionamento
    public function index()
    {
        $professoreslist = Professor::orderBy('nome')->paginate(10);
        $turmaslist = Turma::all();
        $professorall = Professor::all();
        Session::put('quant', 'Foram encontrados '.count($professorall).' professores no banco de dados.');

        return view ('professores_file.professores', compact('professoreslist', 'turmaslist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('professores_file.professores_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataForm = $request->all();
        $user = User::create([
            'name' => $dataForm['usuario'],
            'email' => strtolower($dataForm['email']),
            'password' => bcrypt($dataForm['password']),
            'admin_professor' => 0,
        ]);
        $nascimento = explode('/', $dataForm['nascimento']);
        $dataForm['nascimento'] = $nascimento[2].'-'.$nascimento[1].'-'.$nascimento[0];
        $dataForm += ['cidade' => 'São Leopoldo'];
        $dataForm += ['user_id' => $user->id];
        $pr = Professor::create($dataForm);
        Session::put('mensagem', $dataForm['nome'].' adicionado(a) com sucesso!');

        return redirect()->Route('professor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->admin_professor == 1){
            $professor = Professor::find($id);
            $user = User::find($professor->user_id);
            $useremail = $user->email;

            return view ('professores_file.professores_edit', compact('professor', 'useremail'));
        }
        else{
            $professor = Professor::where('user_id', '=', auth()->user()->id)->first();
            $user = User::find(auth()->user()->id);
            $useremail = $user->email;

            return view ('professores_file.professores_edit', compact('professor', 'useremail'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $professor = Professor::find($id);
        $user = User::find($professor->user_id);
        $dataForm = $request->all();
        $nascimento = explode('/', $dataForm['nascimento']);
        $dataForm['nascimento'] = $nascimento[2].'-'.$nascimento[1].'-'.$nascimento[0];
        $olduser = (array)$user;
        $user->update($dataForm);
        $newuser = (array)$user;
        $oldprofessor = (array)$professor;
        $professor->update($dataForm);
        $newprofessor = (array)$professor;
        if($newprofessor != $oldprofessor){
            Session::put('mensagem', $professor->nome.' editado(a) com sucesso!');
        }
        else if($newuser != $olduser){
            Session::put('mensagem', $professor->nome.' editado(a) com sucesso!');
        }
        if(auth()->user()->admin_professor == 1){

            return redirect()->Route('professor.index');
        }
        else{

            return redirect()->Route('professor_turmas', 1);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $professor = Professor::find($request['id']);
        $nome = $professor->nome;
        $userslist = User::all();
        $user = $userslist->where('id', '=', $professor->user_id)->last();
        $user->delete();
        $professor->delete();
        Session::put('mensagem', $nome.' deletado(a) com sucesso!');

        return redirect()->Route('professor.index');
    }

    public function professor_info($id){
        $professor = Professor::find($id);
        if($professor == null){
            $professoreslist = Professor::onlyTrashed()->get();
            $professor = $professoreslist->find($id);
        }
        return view ('professores_file.professor_info', compact('professor'));
    }

    public function professor_turmas($id){
        $turmas = Turma::orderBy('nome')->get();
        $nucleoslist = Nucleo::orderBy('nome')->get();
        $dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];
        Session::put('quant', 'Foram encontrados '.count($turmas).' pessoas no banco de dados.');
        if(auth()->user()->admin_professor == 1){
            $professor = Professor::find($id);
            foreach($professor->turmas as $p){
                $professorTurmas[] = $p->id;
            }
            return view ('professores_file.professores_turmas', compact('professor','turmas','professorTurmas','dias_semana','nucleoslist'));
        }
        else{
            $professor = Professor::where('user_id', '=', auth()->user()->id)->first();

            return view ('professores_file.professores_turmas', compact('professor', 'turmas', 'dias_semana', 'nucleoslist'));
        }
    }

    public function filtros_professor_turmas($id){
        $turmas = Session::get('turmaslist');
        $nucleoslist = Nucleo::orderBy('nome')->get();
        $dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];
        if(auth()->user()->admin_professor == 1){
            $professor = Professor::find($id);
            foreach($professor->turmas as $turma){
                $professorTurmas[] = $turma->id;
            }
            return view ('professores_file.professores_turmas', compact('professor','turmas','professorTurmas','dias_semana','nucleoslist'));
        }
        else{
            $professor = Professor::where('user_id', '=', auth()->user()->id)->first();

            return view ('professores_file.professores_turmas', compact('professor', 'turmas', 'dias_semana', 'nucleoslist'));
        }
    }

    public function professores_turmas_vincular($idprofessor, $idturma){
        $professor = Professor::find($idprofessor);
        $turma = Turma::find($idturma);

        $professor->turmas()->attach($idturma);
        Session::put('mensagem', $professor->nome . " foi adicionado a turma" . $turma->nome ." com sucesso!");

        return redirect()->Route('professor_turmas', $professor->id);
    }

    public function professores_turmas_desvincular($idprofessor, $idturma){
        $professor = Professor::find($idprofessor);
        $professor->turmas()->detach($idturma);
        return redirect()->Route('professor_turmas', $professor->id);
    }

    public function professor_meus_alunos($idprofessor, $idturma){
        $turma = Turma::find($idturma);
        $pessoaslist = $turma->pessoas;
        Session::put('quant', 'Foram encontrados '.count($pessoaslist).' pessoas no banco de dados.');
        $pessoaslist = $this->ordenar_alfabeto($pessoaslist);
        $pessoaslist = $this->gerar_paginate($pessoaslist);
        $professor = Professor::find($idprofessor);
        $professorid = $professor->id;

        return view ('professores_file.professores_meus_alunos', compact('pessoaslist', 'turma', 'professorid'));
    }

    public function editar_senha(){
        $professor = Professor::where('user_id', '=', auth()->user()->id)->first();

        return view('professores_file.professores_edit_senha', compact('professor'));
    }

    public function update_senha(Request $request, $id){
        $dataForm = $request->all();
        $professor = Professor::find($id);
        $user = User::where('id', '=', $professor->user_id)->first();
        $dataForm['password'] = bcrypt($dataForm['password']);
        $dataForm["admin_professor"] = "0";
        $user->update($dataForm);

        return view('home');
    }

    public function professor_procurar(Request $request){
        $dataForm = array_filter($request->all());
        
        $professoreslist = Professor::where(function($query) use($dataForm){
            if(array_key_exists('nome', $dataForm)){
                $filtro = $dataForm['nome'];
                $query->where('nome', 'like', $filtro."%");
            }
            if(array_key_exists('de', $dataForm)){
                $filtro = explode(' ',$dataForm['de']);
                list($dia, $mes, $ano) = explode('/', $filtro[0]);
                $nascimento = $ano.'-'.$mes.'-'.$dia.' 00:00:00';
                $query->where('nascimento',  '>=', $nascimento);
            }
            if(array_key_exists('ate', $dataForm)){
                $filtro = explode(' ',$dataForm['ate']);
                list($dia, $mes, $ano) = explode('/', $filtro[0]);
                $nascimento = $ano.'-'.$mes.'-'.$dia.' 00:00:00';
                $query->where('nascimento',  '<=', $nascimento);
            }
            if(array_key_exists('email', $dataForm)){
                $filtro = $dataForm['email'];
                $useremails= User::onlyTrashed()->where('email', 'like', $filtro)."%"->where('admin_professor', '=', 0);
                $query->where('user_id', '=', $useremails->id);
            }
            if(array_key_exists('matricula', $dataForm)){
                $filtro = $dataForm['matricula'];
                $query->where('matricula', 'like', $filtro."%");
            }
            if(array_key_exists('telefone', $dataForm)){
                $filtro = $dataForm['telefone'];
                $query->where('telefone', 'like', $filtro."%");
            }
            if(array_key_exists('bairro', $dataForm)){
                $filtro = $dataForm['bairro'];
                $query->where('bairro', 'like', $filtro."%");
            }
            if(array_key_exists('rua', $dataForm)){
                $filtro = $dataForm['rua'];
                $query->where('rua', 'like', $filtro."%");
            }
        })->orderBy('nome')->paginate(10);
        Session::put('quant', 'Foram encontrados '.count($professoreslist).' professores no banco de dados.');

        return view ('professores_file.professores', compact('professoreslist', 'turmaslist'));
    }

    public function professor_procurar_aluno(Request $request){
        $dataForm = $request->all();
        $pessoaslist = Pessoa::orderBy('nome')->paginate(10);
        if($dataForm['nome'] != null){
            $pessoasnome = Pessoa::where('nome', 'like', $dataForm['nome'].'%')->get();
            $pessoaslist = $this->filtrar_dados($pessoaslist, $pessoasnome);
        }
        if($dataForm['de'] != null){
            $pessoaslist = $this->filtrar_ano($pessoaslist, $dataForm['de'], 1);
        }
        if($dataForm['ate'] != null){
            $pessoaslist = $this->filtrar_ano($pessoaslist, $dataForm['ate'], 2);
        }
        if($dataForm['telefone'] != null){
            $pessoastelefone = Pessoa::where('telefone', 'like', $dataForm['telefone'].'%')->get();
            $pessoaslist = $this->filtrar_dados($pessoaslist, $pessoastelefone);
        }
        if(isset($dataForm['sexo'])){
            $pessoassexo = Pessoa::where('sexo', '=', $dataForm['sexo'])->get();
            $pessoaslist = $this->filtrar_dados($pessoaslist, $pessoassexo);
        }
        Session::put('quant', 'Foram encontrados '.count($pessoaslist).' pessoas no banco de dados.');
        $pessoaslist = $this->ordenar_alfabeto($pessoaslist);
        $pessoaslist = $this->gerar_paginate($pessoaslist);
        $turma = Turma::find($dataForm['idturma']);
        $professorid = $dataForm['professorid'];

        return view ('professores_file.professores_meus_alunos', compact('turma','pessoaslist','professorid'));
    }
}
