<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Nucleo;
use App\Turma;
use Illuminate\Support\Facades\Session;

class nucleosController extends Controller
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
        $nucleoslist = Nucleo::orderBy('nome')->paginate(10);
        Session::put('quant', 'Foram encontrados '.count($nucleoslist).' núcleos no banco de dados.');

        return view ('nucleos_file.nucleos', compact('nucleoslist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('nucleos_file.nucleos_create');
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
        $nucleo =  Nucleo::create($dataForm);
        Session::put('mensagem_green', $nucleo->nome.' adicionado com sucesso!');
        return redirect()->Route('nucleos.index');
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
        $nucleo = Nucleo::find($id);
        return view ('nucleos_file.nucleos_edit', compact('nucleo'));
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
        $nucleo = Nucleo::find($id);
        $oldnucleo = (array)$nucleo;
        $nucleo->update($dataForm);
        $newnucleo = (array)$nucleo;
        if($newnucleo != $oldnucleo){
            Session::put('mensagem_green', $nucleo->nome.' editado com sucesso!');
        }
        
        return redirect()->Route('nucleos.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $dataForm = $request->all();
        $nucleo = Nucleo::find($dataForm['id']);
        $turmas = Turma::all();
        foreach($turmas as $turma){
            if($turma->nucleo_id == $nucleo->id){
                Session::put('mensagem_red', 'É necessario excluir todas as turmas vinculadas neste núcleo antes de exclui-lo');
                break;
            }
            else{
                $nome = $nucleo->nome;
                $nucleo->delete();
                Session::put('mensagem_green', $nome.' editado com sucesso!');
            }
        }
        return redirect()->Route('nucleos.index');
    }

    public function turmas_cadastradas($id){
        $nucleo = Nucleo::find($id);
        return view ('nucleos_file.nucleos_turmas', compact('nucleo'));
    }

    public function nucleo_info($id){
        $nucleo = Nucleo::find($id);
        return view ('nucleos_file.nucleos_info', compact('nucleo'));
    }

    public function nucleos_procurar(Request $request){
        $dataForm = $request->all();
        $nucleoslist = Nucleo::all();
        
        if($dataForm['nome'] != null){
            $nucleosnome = Nucleo::orderBy('nome')->where('nome', 'like', '%'.$dataForm['nome'].'%')->get();
            $nucleoslist = $this->filtrar_dados($nucleoslist, $nucleosnome);
        }
        if($dataForm['inativo'] != null){
            $nucleosinativo = Nucleo::orderBy('nome')->where('inativo', '=', $dataForm['inativo'])->get();
            $nucleoslist = $this->filtrar_dados($nucleoslist, $nucleosinativo);
        }
        if($dataForm['bairro'] != null){
            $nucleosbairro = Nucleo::orderBy('nome')->where('bairro', 'like', '%'.$dataForm['bairro'].'%')->get();
            $nucleoslist = $this->filtrar_dados($nucleoslist, $nucleosbairro);
        }
        if($dataForm['rua'] != null){
            $nucleosrua = Nucleo::orderBy('nome')->where('rua', 'like', '%'.$dataForm['rua'].'%')->get();
            $nucleoslist = $this->filtrar_dados($nucleoslist, $nucleosrua);
        }
        if($dataForm['numero_endereco'] != null){
            $nucleosendereco_numero = Nucleo::orderBy('nome')->where('numero_endereco', 'like', '%'.$dataForm['numero_endereco'].'%')->get();
            $nucleoslist = $this->filtrar_dados($nucleoslist, $nucleosendereco_numero);
        }
        if($dataForm['cep'] != null){
            $nucleoscep = Nucleo::orderBy('nome')->where('cep', 'like', '%'.$dataForm['cep'].'%')->get();
            $nucleoslist = $this->filtrar_dados($nucleoslist, $nucleoscep);
        }
        $nucleoslist = $this->ordenar_alfabeto($nucleoslist);
        $nucleoslist = $this->gerar_paginate($nucleoslist);
        Session::put('quant', 'Foram encontrados '.count($nucleoslist).' núcleos no banco de dados.');
        
        return view ('nucleos_file.nucleos', compact('nucleoslist'));
    }
}
