<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\regrasTurma;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Turma;
use App\Nucleo;

class turmasController extends Controller
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
        $nucleoslist = Nucleo::all();
        $turmaslist = Turma::orderBy('nome')->paginate(10);
        $dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];
        Session::put('quant', 'Foram encontrados '.count($turmaslist).' turmas no banco de dados.');

        return view ('turmas_file.turmas', compact('turmaslist', 'nucleoslist', 'dias_semana'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nucleoslist = Nucleo::orderBy('nome')->get();
        $dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];
        return view ('turmas_file.turmas_create', compact('nucleoslist', 'dias_semana'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(regrasTurma $request)
    {
        $dataForm = $request->all();
        $dias_da_semana = '';
        foreach($dataForm['data_semanal'] as $data){
            $dias_da_semana = $dias_da_semana.$data.',';
        }
        $dataForm['data_semanal'] = $dias_da_semana;
        $turma = Turma::create($dataForm);
        Session::put('mensagem', "A turma " . $turma->nome . " foi cadastrada com sucesso!");
        return redirect()->Route('turmas.index');
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
        $turma = Turma::find($id);
        $nucleoslist = Nucleo::all();
        $dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];
        $datas_escolhidas = explode(',', $turma['data_semanal']);
        unset($datas_escolhidas[count($datas_escolhidas) - 1]);
        return view ('turmas_file.turmas_edit', compact('turma', 'nucleoslist', 'dias_semana', 'datas_escolhidas'));
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
        $turma = Turma::find($id);
        $oldturma = (array)$turma;
        $dias_da_semana = '';
        foreach($dataForm['data_semanal'] as $data){
            $dias_da_semana = $dias_da_semana.$data.',';
        }
        $dataForm['data_semanal'] = $dias_da_semana;
        $turma->update($dataForm);
        $newturma = (array)$turma;
        if($newturma != $oldturma){
            Session::put('mensagem', $turma->nome.' adicionada com sucesso!');
        }
        return redirect()->Route('turmas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $turma = Turma::find($request['id']);
        $nome = $turma->nome;
        $turma->delete();
        Session::put('mensagem', $nome.' editado com sucesso!');
        return redirect()->Route('turmas.index');
    }

    public function turmas_procurar(Request $request){
        $dataForm = $request->all();
        $turmaslist = Turma::all();

        if($dataForm['nome'] != null){
            $turmasnome = Turma::orderBy('nome')->where('nome', 'like', $dataForm['nome'].'%')->get();
            $turmaslist = $this->filtrar_dados($turmaslist, $turmasnome);
        }
        if($dataForm['limite'] != null){
            $turmaslimite = Turma::orderBy('nome')->where('limite', '=', $dataForm['limite'])->get();
            $turmaslist = $this->filtrar_dados($turmaslist, $turmaslimite);
        }
        if($dataForm['horario_inicial'] != null){
            $turmashorario_inicial = Turma::orderBy('nome')->where('horario_inicial', 'like', $dataForm['horario_inicial'])->get();
            $turmaslist = $this->filtrar_dados($turmaslist, $turmashorario_inicial);
        }
        if($dataForm['horario_final'] != null){
            $turmashorario_final = Turma::orderBy('nome')->where('horario_final', 'like', $dataForm['horario_final'])->get();
            $turmaslist = $this->filtrar_dados($turmaslist, $turmashorario_final);
        }
        if(isset($dataForm['data_semanal'])){
            $turmasfiltradas = [];
            foreach($turmaslist as $turma){
                $quant = 0;
                $datas_da_turma = explode(',', $turma['data_semanal']);
                unset($datas_da_turma[count($datas_da_turma) - 1]);
                foreach($datas_da_turma as $data){
                    foreach($dataForm['data_semanal'] as $data_escolhida){
                        if($data == $data_escolhida){
                            $quant++;
                        }
                    }
                }
                if($quant == count($dataForm['data_semanal'])){
                    array_push($turmasfiltradas, $turma);
                }
            }
            $turmaslist = $turmasfiltradas;
        }
        if(isset($dataForm['nucleo_id'])){
            $turmasdoencas = [];
            foreach($turmaslist as $turma){
                if($turma['nucleo_id'] == $dataForm['nucleo_id']){
                    array_push($turmasdoencas, $turma);
                }
            }
            $turmaslist = $turmasdoencas;
        }
        $turmaslist = $this->ordenar_alfabeto($turmaslist);
        $turmaslist = $this->gerar_paginate($turmaslist);
        $nucleoslist = Nucleo::All();
        $dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];
        Session::put('quant', 'Foram encontrados '.count($turmaslist).' turmas no banco de dados.');

        return view ('turmas_file.turmas', compact('turmaslist', 'nucleoslist', 'dias_semana'));
    }
}
