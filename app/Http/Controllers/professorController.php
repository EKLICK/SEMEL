<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\Professor\ProfessorCreateFromRequest;
use App\Http\Requests\Professor\ProfessorEditFromRequest;
use App\Http\Requests\Professor\ProfessorProcurarFromRequest;
use App\Http\Requests\Professor\AlunoProcurarFromRequest;
use Illuminate\Validation\Rule;
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
    public function filtrar_dados($arraylists, $arrayfiltros){
        $arraylistfiltradas = [];
        foreach($arrayfiltros as $arrayfiltro){
            foreach($arraylists as $arraylist){
                if($arraylist->id == $arrayfiltro->id){
                    array_push($arraylistfiltradas, $arraylist);
                }
            }
        }

        return $arraylistfiltradas;
    }

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

    public function gerar_paginate($array){
        $itemCollection = collect($array);
        $currentpage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $itemCollection->slice(($currentpage * 10) - 10, 10)->all();
        $itemCollection = new LengthAwarePaginator($currentPageItems, count($itemCollection), 10);
        $itemCollection->setPath('/professor_meus_alunos');

        return $itemCollection;
    }

    public function mostrar_nascimento($data){
        $dia_hora = explode(' ', $data);
        list($ano, $mes, $dia) = explode('-', $dia_hora[0]);
        $data = $dia.'/'.$mes.'/'.$ano;

        return $data;
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
    public function store(ProfessorCreateFromRequest $request)
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
        $professor = Professor::find($id);
        $user = User::find($professor->user_id);
        $professor['nascimento'] = $this->mostrar_nascimento($professor['nascimento']);

        return view ('professores_file.professores_edit', compact('professor', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfessorEditFromRequest $request, $id)
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
        
        return redirect()->Route('professor.index');
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
        foreach($professor->turmas as $turma){
            $professor->turmas()->detach($turma->id);
        }
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
        $professor['nascimento'] = $this->mostrar_nascimento($professor['nascimento']);
        $user = User::find($professor['user_id']);
        $useremail = $user->email;

        return view ('professores_file.professor_info', compact('professor','useremail'));
    }

    public function professor_turmas($id){
        $nucleoslist = Nucleo::orderBy('nome')->get();
        $dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];
        if(auth()->user()->admin_professor == 1){
            $turmaslist = Turma::orderBy('nome')->get();
            Session::put('quant', 'Foram encontrados '.count($turmaslist).' pessoas no banco de dados.');
            $professor = Professor::find($id);
            foreach($professor->turmas as $turma){
                $professorTurmas[] = $turma->id;
            }
            return view ('professores_file.professores_turmas', compact('professor','turmaslist','professorTurmas','dias_semana','nucleoslist'));
        }
        else{
            $professor = Professor::where('user_id', '=', auth()->user()->id)->first();
            $turmaslist = $professor->turmas->sortBy('nome');
            Session::put('quant', 'Foram encontrados '.count($turmaslist).' pessoas no banco de dados.');
            $turmaslist = $this->gerar_paginate($turmaslist);
            return view ('professores_file.professores_turmas', compact('professor', 'turmaslist', 'dias_semana', 'nucleoslist'));
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
        $pessoaslist = $turma->pessoas->sortBy('nome');
        foreach ($pessoaslist as $pessoa){
            $pessoa['nascimento'] = $this->mostrar_nascimento($pessoa['nascimento'], 2);
        }
        $pessoaslist = $this->gerar_paginate($pessoaslist);
        Session::put('quant', 'Foram encontrados '.count($pessoaslist).' pessoas no banco de dados.');
        $professor = Professor::find($idprofessor);
        $professorid = $professor->id;

        return view ('professores_file.professores_meus_alunos', compact('pessoaslist', 'turma', 'professorid'));
    }

    public function professor_procurar(ProfessorProcurarFromRequest $request){
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
                $useremails = User::all()->where('email', 'like', $filtro)->where('admin_professor', '=', 0)->last();
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

    public function filtros_professor_turmas(Request $request, $id){
        $dataForm = array_filter($request->all());
        $professor = Professor::find($id);
        $turmas_professor = $professor->turmas->sortBy('nome');
        $turmaslist = Turma::where(function($query) use($dataForm){
            if(array_key_exists('nome', $dataForm)){
                $filtro = $dataForm['nome'];
                $query->where('nome', 'like', $filtro."%");
            }
            if(array_key_exists('inativo', $dataForm)){
                $filtro = $dataForm['inativo'];
                $query->where('inativo', '=', $filtro."%");
            }
            if(array_key_exists('limite', $dataForm)){
                $filtro = $dataForm['nome'];
                $query->where('nome', 'like', $filtro."%");
            }
            if(array_key_exists('nome', $dataForm)){
                $filtro = $dataForm['nome'];
                $query->where('nome', 'like', $filtro."%");
            }
            if(array_key_exists('nome', $dataForm)){
                $filtro = $dataForm['nome'];
                $query->where('nome', 'like', $filtro."%");
            }
            if(array_key_exists('horario_inicial', $dataForm)){
                $horario = explode(' ', $dataForm['horario_inicial']);
                if($horario[1] == 'PM'){
                    $separador = explode(':', $horario[0]);
                    $separador[0] = 12 + (int)$separador[0];
                    $horario[0] = $separador[0].':'.$separador[1];
                }
                $filtro = $horario[0].':00';
                $query->where('horario_inicial', '>=', $filtro);
            }
            if(array_key_exists('horario_final', $dataForm)){
                $horario = explode(' ', $dataForm['horario_final']);
                if($horario[1] == 'PM'){
                    $separador = explode(':', $horario[0]);
                    $separador[0] = 12 + (int)$separador[0];
                    $horario[0] = $separador[0].':'.$separador[1];
                }
                $filtro = $horario[0].':00';
                $query->where('horario_final', '<=', $filtro);
            }
            if(array_key_exists('data_semanal', $dataForm)){
                $filtro = $dataForm['data_semanal'];
                $query->where('horario_semanal', 'like', '%'.$filtro.'%');
            }
            if(array_key_exists('nucleo_id', $dataForm)){
                $filtro = $dataForm['nucleo_id'];
                $query->where('nucleo_id', '=', $filtro);
            }
        })->orderBy('nome')->get();
        $nucleoslist = Nucleo::orderBy('nome')->get();
        $dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];

        if(auth()->user()->admin_professor == 1){
            Session::put('quant', 'Foram encontrados '.count($turmaslist).' turmas no banco de dados.');
            $turmaslist = $this->gerar_paginate($turmaslist);
            foreach($professor->turmas as $turma){
                $professorTurmas[] = $turma->id;
            }
            return view ('professores_file.professores_turmas', compact('professor','turmaslist','professorTurmas','dias_semana','nucleoslist'));
        }
        else{
            $turmaslist = $this->filtrar_dados($turmaslist, $turmas_professor);
            Session::put('quant', 'Foram encontrados '.count($turmaslist).' turmas no banco de dados.');
            $turmaslist = $this->gerar_paginate($turmaslist);
            $professor = Professor::where('user_id', '=', auth()->user()->id)->first();
            dd($turmaslist);
            return view ('professores_file.professores_turmas', compact('professor', 'turmaslist', 'dias_semana', 'nucleoslist'));
        }
    }

    public function professor_procurar_aluno(AlunoProcurarFromRequest $request){
        $dataForm = array_filter($request->all());
        $turma = Turma::find($dataForm['idturma']);
        $pessoas_turmas = $turma->pessoas;
        $professorid = $dataForm['professorid'];
        $pessoaslist = Pessoa::where(function($query) use($dataForm){
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
            if(array_key_exists('telefone', $dataForm)){
                $filtro = $dataForm['telefone'];
                $query->where('telefone', 'like', $filtro."%");
            }
            if(array_key_exists('sexo', $dataForm)){
                $filtro = $dataForm['sexo'];
                $query->where('sexo', '=', $filtro."%");
            }
        })->orderBy('nome')->get();
        $pessoaslist = $this->filtrar_dados($pessoaslist, $pessoas_turmas);
        $pessoaslist = $this->gerar_paginate($pessoaslist);
        Session::put('quant', 'Foram encontrados '.count($pessoaslist).' pessoas no banco de dados.');

        return view ('professores_file.professores_meus_alunos', compact('turma','pessoaslist','professorid'));
    }
}
