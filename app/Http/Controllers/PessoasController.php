<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pessoa;
use App\Turma;
use Illuminate\Support\Facades\Session;

class PessoasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pessoaslist = Pessoa::all();
        $data = new \DateTime();
        $ano = date('Y');
        return view ('pessoas_file.pessoas', compact('pessoaslist', 'ano'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('pessoas_file.pessoas_create');
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
        $pessoa =  Pessoa::create($dataForm);
        Session::put('pessoa', $pessoa->id);
        return redirect()->Route('anamneses.create');
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
        $pessoa = Pessoa::find($id);
        return view ('pessoas_file.pessoas_edit', compact('pessoa'));
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
        $pessoa = Pessoa::find($id);
        $dataForm = $request->all();
        $pessoa->update($dataForm);
        return redirect()->Route('pessoas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $pessoa = Pessoa::find($request['id']);
        $pessoa->delete();
        return redirect()->Route('pessoas.index');
    }

    public function lista_anamnese($id){
        $pessoa = Pessoa::find($id);
        return view ('Pessoas_file.pessoas_lista_anamnese', compact('pessoa'));
    }

    public function pessoas_info($id){
        $pessoa = Pessoa::find($id);

        return view ('Pessoas_file.pessoas_info', compact('pessoa'));
    }

    public function pessoas_turmas($id){
        $turmas = Turma::all();
        $pessoa = Pessoa::find($id);

        return view ('Pessoas_file.pessoas_turmas', compact('pessoa', 'turmas'));
    }

    public function pessoas_turmas_vincular($id){
        $pessoa = Pessoa::all();

        return view ();
    }
}
