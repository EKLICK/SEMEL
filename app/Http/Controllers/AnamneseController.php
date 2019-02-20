<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;

use App\Http\Requests\Anamnese\AnamneseCreateEditFormRequest;
use App\Http\Requests\Anamnese\AnamneseProcurarFormRequest;

use App\Anamnese;
use App\Pessoa;
use App\Doenca;

class AnamneseController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Funções ferramentas
    //Ferramenta saveDbImageMatricula: Salva a imagem de atestado vindo das requisições do formulario.
    public function saveDbImageAtestado($req){
        $data = $req->all();
        $imagem = $req->file('img_atestado');
        $num = rand(1111, 9999);
        $dir = "img/img_atestado";
        $ex = $imagem->guessClientExtension();
        $nomeImagem = "imagem_".$num.".".$ex;
        $imagem->move($dir, $nomeImagem);
        $data['img_estado'] = $dir."/".$nomeImagem;
        return $data['img_estado'];
    }

    public function ordenar_alfabeto($lista){
        $listapessoas = Pessoa::all();
        $listanomes = [];
        foreach($listapessoas as $pessoa){
            foreach($lista as $arquivo){
                if($pessoa['id'] == $arquivo['pessoas_id']){
                    array_push($listanomes, $pessoa['nome']);
                }
            }
        }
        sort($listanomes);
        $listaordenadapessoas = [];
        foreach($listanomes as $nome){
            foreach($listapessoas as $pessoa){
                if($pessoa['nome'] == $nome){
                    array_push($listaordenadapessoas, $pessoa);
                }
            }
        }
        $listaordenadanome = [];
        foreach($listaordenadapessoas as $pessoa){
            foreach($lista as $arquivo){
                if($pessoa['id'] == $arquivo['pessoas_id']){
                    array_push($listaordenadanome, $arquivo);
                }
            }
        }

        return $listaordenadanome;
    }

    public function gerar_paginate($array, $option){
        $itemCollection = collect($array);
        $currentpage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $itemCollection->slice(($currentpage * 10) - 10, 10)->all();
        $itemCollection = new LengthAwarePaginator($currentPageItems, count($itemCollection), 10);
        if($option == 1){
            $itemCollection->setPath('/anamneses');
        }
        else{
            $itemCollection->setPath('/anamneses_antigas');
        }
        return $itemCollection;
    }
    
    //Funções de Redirecionamento
    public function index(){
        $doencaslist = Doenca::all();
        $ano = date('Y');
        $anamneseslist = Anamnese::where('ano', '=', $ano)->orderBy('ano','desc')->get();
        Session::put('quant', count($anamneseslist).' anamneses de '.$ano.' cadastradas.');

        $anamneseslist = $this->ordenar_alfabeto($anamneseslist);
        $anamneseslist = $this->gerar_paginate($anamneseslist, 1);
        return view ('anamneses_file.anamneses_atualizado', compact('anamneseslist','ano','doencaslist'));
    }

    public function index2(){
        $doencaslist = Doenca::all();
        $ano = date('Y');
        $anamneseslist = Anamnese::orderBy('ano','desc')->where('ano', '!=', $ano)->get();
        Session::put('quant', count($anamneseslist).' anamneses antigas cadastradas.');
        $anamneseslist = $this->ordenar_alfabeto($anamneseslist, 0);
        $anamneseslist = $this->gerar_paginate($anamneseslist, 0);

        return view ('anamneses_file.anamneses_antigas', compact('anamneseslist','ano','doencaslist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    public function anamnese_create($id){
        $pessoa = Pessoa::find($id);
        $ultimaanamnese = Anamnese::where('pessoas_id', '=', $id)->get()->last();
        $hoje = date('Y');
        $data = explode(' ', $pessoa['nascimento']);
        list($dia, $mes, $ano) = explode('-', $data[0]);
        $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);
        $pessoa['nascimento'] = (int)floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);;
        $doencaslist = Doenca::all();

        return view ('anamneses_file.anamneses_create', compact('pessoa','doencaslist','ultimaanamnese'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnamneseCreateEditFormRequest $request){
        $dataForm = $request->all();
        $dataForm += ['ano' => date('Y')];
        if(!empty($dataForm['doencas'])){$dataForm['possui_doenca'] = 1;}
        if($dataForm['toma_medicacao'] == 2){$dataForm['string_toma_medicacao'] == null;}
        if($dataForm['alergia_medicacao'] == 2){$dataForm['string_alergia_medicacao'] == null;}
        if($dataForm['cirurgia'] == 2){$dataForm['string_cirurgia'] == null;}
        if($dataForm['dor_ossea'] == 2){$dataForm['string_dor_ossea'] == null;}
        if($dataForm['dor_muscular'] == 2){$dataForm['string_dor_muscular'] == null;}
        if($dataForm['dor_articular'] == 2){$dataForm['string_dor_articular'] == null;}
        if($dataForm['fumante'] == 2){$dataForm['string_fumante'] = -1;}

        //Se imagem foi passada, salva imagem atestado no banco de dados.
        if(isset($dataForm['img_atestado'])){$dataForm['img_atestado'] = $this->saveDbImageAtestado($request);}
        else{$dataForm['img_atestado'] = null;}

        $anamnese = Anamnese::create([
            'possui_doenca' => $dataForm['possui_doenca'],
            'toma_medicacao' => $dataForm['string_toma_medicacao'],
            'alergia_medicacao' => $dataForm['string_alergia_medicacao'],
            'peso' => $dataForm['peso'],
            'altura' => $dataForm['altura'],
            'fumante' => $dataForm['string_fumante'],
            'cirurgia' => $dataForm['string_cirurgia'],
            'dor_muscular' => $dataForm['string_dor_muscular'],
            'dor_articular' => $dataForm['string_dor_articular'],
            'dor_ossea' => $dataForm['string_dor_ossea'],
            'atestado' => $dataForm['img_atestado'],
            'observacao' => $dataForm['observacao'],
            'ano' => date('Y'),
            'pessoas_id' => $pessoa->id,
        ]);
        if(!empty($dataForm['doencas'])){
            $anamnese->doencas()->attach($dataForm['doencas']);
        }
        Session::put('mensagem_green','Anamnese adicionada com sucesso!');

        return redirect()->route('lista_anamnese', $dataForm['pessoas_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $doencaslist = Doenca::all();
        $anamnese = Anamnese::find($id);
        if($anamnese->ano != date('Y')){
            return redirect()->route('anamneses.index2');
        }
        return view ('anamneses_file.anamneses_edit', compact ('anamnese','doencaslist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnamneseCreateEditFormRequest $request, $id){
        $dataForm = $request->all();
        $anamnese = Anamnese::find($id);
        $oldanamnese = (array)$anamnese;

        if(!empty($dataForm['doencas'])){$dataForm['possui_doenca'] = 1;}
        if($dataForm['toma_medicacao'] == 2){$dataForm['string_toma_medicacao'] = -1;}
        if($dataForm['alergia_medicacao'] == 2){$dataForm['string_alergia_medicacao'] = -1;}
        if($dataForm['cirurgia'] == 2){$dataForm['string_cirurgia'] = -1;}
        if($dataForm['dor_ossea'] == 2){$dataForm['string_dor_ossea'] = -1;}
        if($dataForm['dor_muscular'] == 2){$dataForm['string_dor_muscular'] = -1;}
        if($dataForm['dor_articular'] == 2){$dataForm['string_dor_articular'] = -1;}
        if($dataForm['fumante'] == 2){$dataForm['string_fumante'] = -1;}

        //Verifica se a imagem de atestado foi passada pelo formulario
        if(isset($dataForm['img_atestado'])){
            //Se sim, remove imagem antiga e salva imagem nova no banco de dados.
            if(!empty($anamnese['atestado'])){unlink($anamnese['atestado']);}
            $dataForm['img_atestado'] = $this->saveDbImageAtestado($request);
        }
        elseif(isset($anamnese['atestado'])){
            //Se a imagem não foi passada, porém permanece com o link antigo, apenas repeto o valor que está no banco de dados para criação
            $dataForm += ['img_atestado' => $anamnese['atestado']];
        }
        else{
            //Se não, atribuir nulo e deleta a imagem.
            unlink($anamnese['atestado']);
            $dataForm += ['img_atestado' => null];
        }

        $anamnese->update([
            'possui_doenca' => $dataForm['possui_doenca'],
            'toma_medicacao' => $dataForm['string_toma_medicacao'],
            'alergia_medicacao' => $dataForm['string_alergia_medicacao'],
            'peso' => $dataForm['peso'],
            'altura' => $dataForm['altura'],
            'fumante' => $dataForm['string_fumante'],
            'cirurgia' => $dataForm['string_cirurgia'],
            'dor_muscular' => $dataForm['string_dor_muscular'],
            'dor_articular' => $dataForm['string_dor_articular'],
            'dor_ossea' => $dataForm['string_dor_ossea'],
            'atestado' => $dataForm['img_atestado'],
            'observacao' => $dataForm['observacao'],
            'ano' => date('Y'),
            'pessoas_id' => $dataForm['pessoa_id'],
        ]);
        if(isset($dataForm['doencas']))
            $anamnese->doencas()->sync($dataForm['doencas']);
        $newanamnese = (array)$anamnese;
        if($newanamnese != $oldanamnese){
            Session::put('mensagem_green', "Anamnese editada com sucesso!");
        } 
        return redirect()->route('anamneses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }

    public function anamnese_info($id){
        $anamnese = Anamnese::find($id);
        $pessoa = Pessoa::find($anamnese->pessoas);
        $ano = date('Y');

        return view ('anamneses_file.anamneses_info', compact('anamnese','pessoa','ano'));
    }

    public function pdfanamnese($id){
        $anamnese = Anamnese::find($id);
        $pessoa = Pessoa::find($anamnese->pessoas->id);
        $nome = $pessoa->nome;

        return \PDF::loadview('pdf_file.anamneses_pdf', compact('anamnese','nome'))->stream('PDF_registro_pessoa'.'.pdf');
    }
}
