<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function index()
    {
        $professoreslist = Professor::orderBy('nome')->paginate(10);
        return view ('professores_file.professores', compact('professoreslist'));
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

        Professor::create($dataForm);
        Session::put('mensagem', $dataForm->nome.' adicionado(a) com sucesso!');
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
        $professor->delete();
        Session::put('mensagem', $nome.' deletado(a) com sucesso!');
        return redirect()->Route('professor.index');
    }

    public function professor_info($id){
        $professor = Professor::find($id);

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

    public function professor_meus_alunos($id){
        $turma = Turma::find($id);
        
        return view ('professores_file.professores_meus_alunos', compact('turma'));
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
}
