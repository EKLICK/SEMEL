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

    //Funções de Redirecionamento
    public function index()
    {
        $nucleoslist = Nucleo::all();
        $turmaslist = Turma::orderBy('nome')->paginate(10);
        return view ('turmas_file.turmas', compact('turmaslist', 'nucleoslist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nucleoslist = Nucleo::all();

        return view ('turmas_file.turmas_create', compact('nucleoslist'));
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
        return view ('turmas_file.turmas_edit', compact('turma', 'nucleoslist'));
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
        $turmaslist = new LengthAwarePaginator($turmaslist, count($turmaslist), 10, null);
        $turmaslist->setPath('/turmas');
        $nucleoslist = Nucleo::All();

        return view ('turmas_file.turmas', compact('turmaslist', 'nucleoslist'));
    }
}
