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

    //Funções ferramentas
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
        $doencaall = Doenca::all();
        $doencaslist = Doenca::orderBy('nome')->paginate(10);
        Session::put('quant', 'Foram encontrados '.count($doencaall).' doenças no banco de dados.');

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

    public function doencas_procurar(Request $request){
        $dataForm = $request->all();
        $doencaslist = Doenca::all();
        if($dataForm['nome'] != null){
            $doencaslist = Doenca::orderBy('nome')->where('nome', 'like', $dataForm['nome'].'%')->paginate(10);
        }
        Session::put('quant', 'Foram encontrados '.count($doencaslist).' doenças no banco de dados.');
        $doencaslist = ordenar_alfabeto($doencaslist);
        $doencaslist = gerar_paginate($doencaslist);

        return view ('doencas_file.doencas', compact('doencaslist'));
    }
}
