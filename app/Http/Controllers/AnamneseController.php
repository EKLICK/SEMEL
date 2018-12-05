<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
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

    public function ordenar_ano($lista, $option){
        $listaordenada = [];
        if($option == 0){
            $ano = (int)date('Y') - 1;
        }
        else{
            $ano = (int)date('Y');
        }
        for($i = $ano; $i > 1900; $i--){
            $listafiltradaano = [];
            foreach($lista as $arquivo){
                if($arquivo['ano'] == $i){
                    array_push($listafiltradaano, $arquivo);
                }
            }

            $listaordenadanome = $this->ordenar_alfabeto($listafiltradaano);

            foreach($listaordenadanome as $arquivo){
                array_push($listaordenada, $arquivo);
            }
            
            if($option == 1){
                break;
            }
        }
        return $listaordenada;
    }
    
    //Funções de Redirecionamento
    public function index()
    {
        $doencaslist = Doenca::all();
        $ano = date('Y');
        $anamneseslist = Anamnese::orderBy('ano','desc')->where('ano', '=', date('Y'))->get();
        $anamnesesordenadas = $this->ordenar_alfabeto($anamneseslist);
        $anamneseslist = new LengthAwarePaginator($anamnesesordenadas, count($anamnesesordenadas), 10, null);

        return view ('anamneses_file.anamneses_atualizado', compact('anamneseslist', 'ano', 'doencaslist'));
    }

    public function index2(){
        $doencaslist = Doenca::all();
        $ano = date('Y');
        $anamneseslist = Anamnese::orderBy('ano','desc')->where('ano', '!=', date('Y'))->get();
        $anamnesesordenadas = $this->ordenar_ano($anamneseslist, 0);
        $anamneseslist = new LengthAwarePaginator($anamnesesordenadas, count($anamnesesordenadas), 10, null);
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
                $anamnesesdepeso = Anamnese::where('peso', '>=', $dataForm['de_peso'])->where('ano', '<', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesdepeso);
            }
            else{
                $anamnesesdepeso = Anamnese::where('peso', '>=', $dataForm['de_peso'])->where('ano', '=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesdepeso);
            }
        }
        if($dataForm['ate_peso'] != null){
            if($dataForm['escolha'] == 0){
                $anamnesesatepeso = Anamnese::where('peso', '<=', $dataForm['ate_peso'])->where('ano', '<', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesdepeso);
            }
            else{
                $anamnesesatepeso = Anamnese::where('peso', '<=', $dataForm['ate_peso'])->where('ano', '=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesdepeso);
            }
        }
        if($dataForm['de_altura'] != null){
            if($dataForm['escolha'] == 0){
                $anamnesesdealtura = Anamnese::where('altura', '>=', $dataForm['de_altura'])->where('ano', '<', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesdealtura);
            }
            else{
                $anamnesesdealtura = Anamnese::where('altura', '>=', $dataForm['de_altura'])->where('ano', '=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesdealtura);
            }
        }
        if($dataForm['ate_altura'] != null){
            if($dataForm['escolha'] == 0){
                $anamnesesatealtura = Anamnese::where('altura', '<=', $dataForm['ate_altura'])->where('ano', '<', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesatealtura);
            }
            else{
                $anamnesesatealtura = Anamnese::where('altura', '<=', $dataForm['ate_altura'])->where('ano', '=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesatealtura);
            }
        }
        if(isset($dataForm['toma_medicacao'])){
            if($dataForm['escolha'] == 0){
                $anamnesestomamedicacao = Anamnese::where('toma_medicacao', '=', $dataForm['toma_medicacao'])->where('ano', '<=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesestomamedicacao);
            }
            else{
                $anamnesestomamedicacao = Anamnese::where('toma_medicacao', '=', $dataForm['toma_medicacao'])->where('ano', '=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesestomamedicacao);
            }
        }
        if(isset($dataForm['cirurgia'])){
            if($dataForm['escolha'] == 0){
                $anamnesescirurgia = Anamnese::where('cirurgia', '=', $dataForm['cirurgia'])->where('ano', '<=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesescirurgia);
            }
            else{
                $anamnesescirurgia = Anamnese::where('cirurgia', '=', $dataForm['cirurgia'])->where('ano', '=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesescirurgia);
            }
        }
        if(isset($dataForm['fumante'])){
            if($dataForm['escolha'] == 0){
                $anamnesesfumante = Anamnese::where('fumante', '=', $dataForm['fumante'])->where('ano', '<=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesfumante);
            }
            else{
                $anamnesesfumante = Anamnese::where('fumante', '=', $dataForm['fumante'])->where('ano', '=', date('Y'))->get();
                $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesfumante);
            }
        }
        if(isset($dataForm['doencas'])){
            $anamnesesdoencas = [];
            foreach($anamneseslist as $anamnese){
                $quant = 0;
                foreach($anamnese['doencas'] as $doenca){
                    
                    foreach($dataForm['doencas'] as $doencadalista){
                        if($doenca['id'] == $doencadalista){
                            $quant++;
                        }
                    }
                }
                if($quant == count($anamnese['doencas']) and $quant == count($dataForm['doencas'])){
                    array_push($anamnesesdoencas, $anamnese);
                }
            }
            $anamneseslist = $this->filtrar_dados($anamneseslist, $anamnesesdoencas);
        }
        $anamneseslist = $this->ordenar_ano($anamneseslist, $dataForm['escolha']);

        $anamneseslist = new LengthAwarePaginator($anamneseslist, count($anamneseslist), 10, null);
        $doencaslist = Doenca::all();
        $ano = date('Y');

        if($dataForm['escolha'] == 0){
            return view ('anamneses_file.anamneses_antigas', compact('anamneseslist', 'ano', 'doencaslist'));
        }
        else{
            return view ('anamneses_file.anamneses_atualizado', compact('anamneseslist', 'ano', 'doencaslist'));
        }
    }
}
