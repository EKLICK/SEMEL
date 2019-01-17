<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\Professor\ProfessorCreateFormRequest;
use App\Http\Requests\Professor\ProfessorEditFormRequest;
use App\Http\Requests\Professor\ProfessorProcurarFormRequest;
use App\Http\Requests\Professor\AlunoProcurarFormRequest;
use App\Http\Requests\Turma\TurmaProcurarFormRequest;
use Illuminate\Validation\Rule;
use App\User;
use App\Professor;
use App\Turma;
use App\Nucleo;
use App\Pessoa;
use App\Bairro;
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
    public function store(ProfessorCreateFormRequest $request)
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
        $dataForm += ['user_id' => $user->id];
        Professor::create($dataForm);
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
    public function update(ProfessorEditFormRequest $request, $id)
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
        $nucleoslist = Nucleo::orderBy('nome');
        $dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];
        if(auth()->user()->admin_professor == 1){
            $turmaslist = Turma::orderBy('nome')->paginate(10);
            Session::put('quant', 'Foram encontrados '.count($turmaslist->all()).' pessoas no banco de dados.');
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
}
