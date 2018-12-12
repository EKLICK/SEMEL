<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Audit;

class auditsController extends Controller
{
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

    public function ordenar_alfabeto($lista){
        $listanomes = [];
        foreach($lista as $arquivo){
            array_push($listanomes, $arquivo['created_at']);
        }
        sort($listanomes);
        $listaordenadanome = [];
        foreach($listanomes as $nome){
            foreach($lista as $arquivo){
                if($arquivo['created_at'] == $nome){
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
        $itemCollection->setPath('/audits');

        return $itemCollection;
    }

    //Funções de Redirecionamento
    public function index(){
        $auditslist = Audit::orderBy('created_at')->paginate(10);
        $auditall = Audit::all();
        Session::put('quant', 'Foram encontrados '.count($auditall).' auditorias no banco de dados.');
        $eventos = ['Criação','Edição','Exclusão'];
        $tabelas = ['Usuários','Professores','Clientes','Anamneses','Doenças','Turmas','Núcleos'];

        return view ('audits_file.audits', compact('auditslist','eventos','tabelas'));
    }

    public function info($id){
        $audit = Audit::find($id);

        return view ('audits_file.audits_info', compact('audit'));
    }

    public function audits_procurar(Request $request){
        $dataForm = $request->all();
        $auditslist = Audit::all();
        if(isset($dataForm['eventos'])){
            $i = $dataForm['eventos'];
            switch ($i[0]) {
                case 0:
                    $auditsevento = Audit::orderBy('created_at')->where('event', '=', 'created')->get();
                    $auditslist = $this->filtrar_dados($auditslist, $auditsevento);
                    break;
                case 1:
                    $auditsevento = Audit::orderBy('created_at')->where('event', '=', 'updated')->get();
                    $auditslist = $this->filtrar_dados($auditslist, $auditsevento);
                    break;
                case 2:
                    $auditsevento = Audit::orderBy('created_at')->where('event', '=', 'delete')->get();
                    $auditslist = $this->filtrar_dados($auditslist, $auditsevento);
                    break;
            }
        }
        if(isset($dataForm['tabelas'])){
            $i = $dataForm['tabelas'];
            switch ($i[0]) {
                case 0:
                    $auditstabela = Audit::orderBy('created_at')->where('auditable_type', '=', 'App\user')->get();
                    $auditslist = $this->filtrar_dados($auditslist, $auditstabela);
                    break;
                case 1:
                    $auditstabela = Audit::orderBy('created_at')->where('auditable_type', '=', 'App\Professor')->get();
                    $auditslist = $this->filtrar_dados($auditslist, $auditstabela);
                    break;
                case 2:
                    $auditstabela = Audit::orderBy('created_at')->where('auditable_type', '=', 'App\Pessoa')->get();
                    $auditslist = $this->filtrar_dados($auditslist, $auditstabela);
                    break;
                case 3:
                    $auditstabela = Audit::orderBy('created_at')->where('auditable_type', '=', 'App\Anamnese')->get();
                    $auditslist = $this->filtrar_dados($auditslist, $auditstabela);
                    break;
                case 4:
                    $auditstabela = Audit::orderBy('created_at')->where('auditable_type', '=', 'App\Doenca')->get();
                    $auditslist = $this->filtrar_dados($auditslist, $auditstabela);
                    break;
                case 5:
                    $auditstabela = Audit::orderBy('created_at')->where('auditable_type', '=', 'App\Turma')->get();
                    $auditslist = $this->filtrar_dados($auditslist, $auditstabela);
                    break;
                case 6:
                    $auditstabela = Audit::orderBy('created_at')->where('auditable_type', '=', 'App\Nucleo')->get();
                    $auditslist = $this->filtrar_dados($auditslist, $auditstabela);
                    break;
            }
        }
        Session::put('quant', 'Foram encontrados '.count($auditslist).' Auditorias no banco de dados.');
        $auditslist = $this->ordenar_alfabeto($auditslist);
        $auditslist = $this->gerar_paginate($auditslist);
        $eventos = ['Criação','Edição','Exclusão'];
        $tabelas = ['Usuários','Professores','Clientes','Anamneses','Doenças','Turmas','Núcleos'];
        
        return view('audits_file.audits', compact('auditslist', 'eventos', 'tabelas'));
    }
}
