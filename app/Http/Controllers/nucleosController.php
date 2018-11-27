<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function index()
    {
        $nucleoslist = Nucleo::orderBy('nome')->paginate(10);

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
}
