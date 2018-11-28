<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doenca;
use Illuminate\Support\Facades\Session;

class doencasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doencaslist = Doenca::orderBy('nome')->paginate(10);
        return view ('doencas_file.doencas', compact('doencaslist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('doencas_file.doencas_create');
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
        Doenca::create($dataForm);
        Session::put('mensagem', $dataForm['nome'].' adicionada com sucesso!');
        return redirect()->Route('doencas.index');
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
        $doenca = Doenca::find($id);
        return view ('doencas_file.doencas_edit', compact('doenca'));
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
        $dataForm = $request->all();
        $doenca = Doenca::find($id);
        $olddoenca = (array)$doenca;
        $doenca->update($dataForm);
        $newdoenca = (array)$doenca;
        if($olddoenca != $newdoenca){
            Session::put('mensagem', $doenca->nome.' editada com sucesso!');
        }
        return redirect()->Route('doencas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $doenca = Doenca::find($request['id']);
        $nome = $doenca->nome;
        $doenca->delete();
        Session::put('mensagem', $nome.' deletada com sucesso!');
        return redirect()->Route('doencas.index');
    }
}
