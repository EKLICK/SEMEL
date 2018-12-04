<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anamnese;
use App\Pessoa;
use App\Doenca;
use Illuminate\Support\Facades\Session;

class AnamneseController extends Controller
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
    
    //Funções de Redirecionamento
    public function index()
    {
        $doencaslist = Doenca::all();
        $ano = date('Y');
        $anamneseslist = Anamnese::orderBy('ano','desc')->where('ano', '=', date('Y'))->paginate(10);
        return view ('anamneses_file.anamneses_atualizado', compact('anamneseslist', 'ano', 'doencaslist'));
    }

    public function index2(){
        $doencaslist = Doenca::all();
        $ano = date('Y');
        $anamneseslist = Anamnese::orderBy('ano','desc')->where('ano', '!=', date('Y'))->paginate(10);
        return view ('anamneses_file.anamneses_antigas', compact('anamneseslist', 'ano', 'doencaslist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pessoa_id = Session::get('pessoa');
        Session::forget('pessoa');
        $pessoa = Pessoa::find($pessoa_id);
        $doencaslist = Doenca::all();
        return view ('anamneses_file.anamneses_create', compact('pessoa', 'doencaslist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $doencaslist = Doenca::all();
        $anamnese = Anamnese::find($id);
        return view ('anamneses_file.anamneses_edit', compact ('anamnese', 'doencaslist'));
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
        if(!empty($dataForm['doencas'])){
            $dataForm['possui_doenca'] = 1;
        }
        $anamnese = Anamnese::find($id);
        $oldanamnese = (array)$anamnese;
        $anamnese->update($dataForm);
        if(isset($dataForm['doencas']))
            $anamnese->doencas()->sync($dataForm['doencas']);
        $newanamnese = (array)$anamnese;
        if($newanamnese != $oldanamnese){
            Session::put('mensagem', "Anamnese editada com sucesso!");
        } 
        return redirect()->Route('anamneses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function anamnese_info($id){
        $anamnese = Anamnese::find($id);
        $pessoa = Pessoa::find($anamnese->pessoas);

        return view ('anamneses_file.anamneses_info', compact('anamnese', 'pessoa'));
    }

    public function pdfanamnese($id){
        $anamnese = Anamnese::find($id);
        $pessoa = Pessoa::find($anamnese->pessoas->id);
        $nome = $pessoa->nome;

        return \PDF::loadview('pdf_file.anamneses_pdf', compact('anamnese', 'nome'))->stream('PDF_registro_pessoa'.'.pdf');
    }

    public function anamnese_procurar(Request $request){
        $data = new \DateTime();
        $dataForm = $request->all();
        if($dataForm['escolha'] == 0){
            $anamneseslist = Anamnese::where('ano', '<', date('Y'))->get();
        }
        else{
            $anamneseslist = Anamnese::where('ano', '=', date('Y'))->get();
        }
        if($dataForm['de_peso'] != null){
            if($dataForm['escolha'] == 0){
                $anamnesesdepeso = Anamnese::where('peso', '>=', $dataForm['de_peso'])->where('ano', '<=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesdepeso);
            }
            else{
                $anamnesesdepeso = Anamnese::where('peso', '>=', $dataForm['de_peso'])->where('ano', '=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesdepeso);
            }
        }
        if($dataForm['ate_peso'] != null){
            if($dataForm['escolha'] == 0){
                $anamnesesdepeso = Anamnese::where('peso', '<=', $dataForm['ate_peso'])->where('ano', '<=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesdepeso);
            }
            else{
                $anamnesesdepeso = Anamnese::where('peso', '<=', $dataForm['ate_peso'])->where('ano', '=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesdepeso);
            }
        }
        if($dataForm['de_altura'] != null){
            if($dataForm['escolha'] == 0){
                $anamnesesdepeso = Anamnese::where('altura', '>=', $dataForm['de_altura'])->where('ano', '<=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesdepeso);
            }
            else{
                $anamnesesdepeso = Anamnese::where('altura', '>=', $dataForm['de_altura'])->where('ano', '=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesdepeso);
            }
        }
        if($dataForm['ate_altura'] != null){
            if($dataForm['escolha'] == 0){
                $anamnesesdepeso = Anamnese::where('altura', '<=', $dataForm['ate_altura'])->where('ano', '<=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesdepeso);
            }
            else{
                $anamnesesdepeso = Anamnese::where('altura', '<=', $dataForm['ate_altura'])->where('ano', '=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesdepeso);
            }
        }
        if(isset($dataForm['toma_medicacao'])){
            if($dataForm['escolha'] == 0){
                $anamnesesdepeso = Anamnese::where('toma_medicacao', '=', $dataForm['toma_medicacao'])->where('ano', '<=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesdepeso);
            }
            else{
                $anamnesesdepeso = Anamnese::where('toma_medicacao', '=', $dataForm['toma_medicacao'])->where('ano', '=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesdepeso);
            }
        }
        if(isset($dataForm['cirurgia'])){
            if($dataForm['escolha'] == 0){
                $anamnesesdepeso = Anamnese::where('cirurgia', '=', $dataForm['cirurgia'])->where('ano', '<=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesdepeso);
            }
            else{
                $anamnesesdepeso = Anamnese::where('cirurgia', '=', $dataForm['cirurgia'])->where('ano', '=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesdepeso);
            }
        }
        if(isset($dataForm['fumante'])){
            if($dataForm['escolha'] == 0){
                $anamnesesdepeso = Anamnese::where('fumante', '=', $dataForm['fumante'])->where('ano', '<=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesdepeso);
            }
            else{
                $anamnesesdepeso = Anamnese::where('fumante', '=', $dataForm['fumante'])->where('ano', '=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesdepeso);
            }
        }
        if(isset($dataForm['doencas'])){
            $anamnesesselecionadas = [];
            foreach($anamneseslist as $anamnese){
                $count = 0;
                foreach($anamnese['doencas'] as $doencasdapessoa){
                    foreach($dataForm['doencas'] as $doencasdalista){
                        if($doencasdalista['id'] == $doencasdapessoa['id']){
                            $count++;
                        }
                    }
                }
                if($count == count($dataForm['doencas'])){
                    array_push($anamnesesselecionadas, $anamnese);
                }
            }
        }
        dd($anamneseslist);
    }
}
