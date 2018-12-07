<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\User;
use App\Professor;
use App\Turma;
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
                if($arraylist == $arrayfiltro){
                    array_push($arraylistfiltradas, $arraylist);
                }
            }
        }

        return $arraylistfiltradas;
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
        $itemCollection->setPath('/anamneses_antigas');
        return $itemCollection;
    }

    //Funções de Redirecionamento
    public function index()
    {
        $professoreslist = Professor::orderBy('nome')->paginate(10);
        $turmaslist = Turma::all();
        Session::put('quant', 'Foram encontrados '.count($professoreslist).' professores no banco de dados.');
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
            'name' => $dataForm['nome'],
            'email' => strtolower($dataForm['email']),
            'password' => bcrypt($dataForm['password']),
            'admin_professor' => 0,
        ]);
        $dataForm += ['user_id' => $user->id];
        unset($dataForm->password);
        unset($dataForm->email);
        dd($dataForm);
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
        if(auth()->user()->admin_professor == 1){
            $professor = Professor::find($id);
        }
        else{
            $professor = Professor::where('user_id', '=', auth()->user()->id)->first();
        }

        return view ('professores_file.professores_edit', compact('professor'));
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
        $dataForm = $request->all();
        $oldprofessor = (array)$professor;
        $professor->update($dataForm);
        $newprofessor = (array)$professor;
        if($newprofessor != $oldprofessor){
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
        $turmas = Turma::all();
        if(auth()->user()->admin_professor == 1){
            $professor = Professor::find($id);
            foreach($professor->turmas as $p){
                $professorTurmas[] = $p->id;
            }
            return view ('professores_file.professores_turmas', compact('professor', 'turmas', 'professorTurmas'));
        }
        else{
            $professor = Professor::where('user_id', '=', auth()->user()->id)->first();

            return view ('professores_file.professores_turmas', compact('professor', 'turmas'));
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
        $professor = Professor::find($idprofessor);
        $professorid = $professor->id;
        
        return view ('professores_file.professores_meus_alunos', compact('turma', 'professorid'));
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

    public function softdeletes(){
        $professoreslist = Professor::onlyTrashed()->paginate(10);
        Session::put('quant', 'Foram encontrados '.count($professoreslist).' pessoas deletadas no banco de dados.');
        
        return view ('professores_file.professores_softdeletes', compact('professoreslist'));
    }

    public function restore($id){
        $professoreslist = Professor::onlyTrashed()->get();
        $professor = $professoreslist->find($id);

        $userslist = User::onlyTrashed()->get();
        $user = $userslist->where('id', '=', $professor->user_id)->last();
        $user->restore();
        $professor->restore();

        return redirect()->route('professor.index');
    }

    public function professor_procurar(Request $request){
        $dataForm = $request->all();
        $professoreslist = Professor::all();
        $turmaslist = Turma::all();

        if($dataForm['nome'] != null){
            $professoresnome = Professor::orderBy('nome')->where('nome', 'like', $dataForm['nome'].'%')->get();
            $professoreslist = $this->filtrar_dados($professoreslist, $professoresnome);
        }
        if($dataForm['email'] != null){
            $professoresemail = [];
            $useremails= User::orderBy('name')->where('email', 'like', $dataForm['email'])->where('admin_professor', '=', 0)->get();
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
            $professoresmatricula = Professor::orderBy('nome')->where('matricula', 'like', $dataForm['matricula'].'%')->get();
            $professoreslist = $this->filtrar_dados($professoreslist, $professoresmatricula);
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
        $professoreslist = $this->ordenar_alfabeto($professoreslist);
        $professoreslist = $this->gerar_paginate($professoreslist);

        return view ('professores_file.professores', compact('professoreslist', 'turmaslist'));
    }
}
