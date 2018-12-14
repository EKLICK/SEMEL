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

    public function ordenar_alfabeto($lista){
        $listanomes = [];
        foreach($lista as $arquivo){
            array_push($listanomes, $arquivo['nome']);
        }
        sort($listanomes);
        $listaordenadanome = [];
        foreach($listanomes as $nome){
            foreach($lista as $arquivo){
                if($arquivo['nome'] == $nome){
                    array_push($listaordenadanome, $arquivo);
                }
            }
        }
        
        return $listaordenadanome;
    }

    public function gerar_paginate($array){
        $itemCollection = collect($array);
        $currentpage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $itemCollection->slice(($currentpage * 10) - 10, 10)->all();
        $itemCollection = new LengthAwarePaginator($currentPageItems, count($itemCollection), 10);
        $itemCollection->setPath('/professor');
        return $itemCollection;
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
        $dataForm = $request->all();
        $turmaslist = Turma::all();
        if(isset($dataForm['softdelete'])){
            $pessoaslist = Professor::onlyTrashed()->get();
        }
        else{
            $professoreslist = Professor::orderBy('nome')->get();
        }

        if($dataForm['nome'] != null){
            if(isset($dataForm['softdelete'])){
                $professoresnome = Professor::onlyTrashed()->where('nome', 'like', $dataForm['nome'].'%')->get();
            }
            else{
                $professoresnome = Professor::where('nome', 'like', $dataForm['nome'].'%')->get();
            }
            $professoreslist = $this->filtrar_dados($professoreslist, $professoresnome);
        }
        if($dataForm['de'] != null){
            $professoreslist = $this->filtrar_ano($professoreslist, $dataForm['de'], 1);
        }
        if($dataForm['ate'] != null){
            $professoreslist = $this->filtrar_ano($professoreslist, $dataForm['ate'], 2);
        }
        if($dataForm['email'] != null){
            $professoresemail = [];
            if(isset($dataForm['softdelete'])){
                $useremails= User::onlyTrashed()->where('email', 'like', $dataForm['email'])->where('admin_professor', '=', 0)->get();
            }
            else{
                $useremails= User::where('email', 'like', $dataForm['email'])->where('admin_professor', '=', 0)->get();
            }
            foreach($professoreslist as $professor){
                foreach($useremails as $useremail){
                    if($professor['user_id'] == $useremail['id']){
                        array_push($professoresemail, $professor);
                    }
                }
            }
            $professoreslist = $this->filtrar_dados($professoreslist, $professoresemail);
        }
        if($dataForm['matricula'] != null){
            if(isset($dataForm['softdelete'])){
                $professoresmatricula = Professor::onlyTrashed()->where('matricula', 'like', $dataForm['matricula'].'%')->get();
            }
            else{
                $professoresmatricula = Professor::where('matricula', 'like', $dataForm['matricula'].'%')->get();
            }
            $professoreslist = $this->filtrar_dados($professoreslist, $professoresmatricula);
        }
        if($dataForm['telefone'] != null){
            if(isset($dataForm['softdelete'])){
                $professorestelefone = Professor::onlyTrashed()->where('telefone', 'like', $dataForm['telefone'].'%')->get();
            }
            else{
                $professorestelefone = Professor::where('telefone', 'like', $dataForm['telefone'].'%')->get();
            }
            $professoreslist = $this->filtrar_dados($professoreslist, $professorestelefone);
        }
        if($dataForm['bairro'] != null){
            if(isset($dataForm['softdelete'])){
                $professoresbairro = Professor::onlyTrashed()->where('bairro', 'like', $dataForm['bairro'].'%')->get();
            }
            else{
                $professoresbairro = Professor::where('bairro', 'like', $dataForm['bairro'].'%')->get();
            }
            $professoreslist = $this->filtrar_dados($professoreslist, $professoresbairro);
        }
        if($dataForm['rua'] != null){
            if(isset($dataForm['softdelete'])){
                $professoresrua = Professor::onlyTrashed()->where('rua', 'like', $dataForm['rua'].'%')->get();
            }
            else{
                $professoresrua = Professor::where('rua', 'like', $dataForm['rua'].'%')->get();
            }
            $professoreslist = $this->filtrar_dados($professoreslist, $professoresrua);
        }
        if(isset($dataForm['turmas'])){
            $professoresturmas = [];
            foreach($professoreslist as $professor){
                $quant = 0;
                foreach ($professor['turmas'] as $turmasdoprofessor) {
                    foreach($dataForm['turmas'] as $turmasselecionadas){
                        if($turmasdoprofessor['id'] == $turmasselecionadas){
                            $quant++;
                        }
                    }
                }
                if($quant == count($dataForm['turmas'])){
                    array_push($professoresturmas, $professor);
                }
            }
            $professoreslist = $this->filtrar_dados($professoreslist, $professoresturmas);
        }
        Session::put('quant', 'Foram encontrados '.count($professoreslist).' professores no banco de dados.');
        $professoreslist = $this->ordenar_alfabeto($professoreslist);
        $professoreslist = $this->gerar_paginate($professoreslist);

        if(isset($dataForm['softdelete'])){
            return view ('professores_file.professores_softdeletes', compact('professoreslist'));
        }
        else{
            return view ('professores_file.professores', compact('professoreslist', 'turmaslist'));
        }
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
