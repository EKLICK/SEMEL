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

    //Funções de Redirecionamento
    public function index()
    {
        $nucleoall = Nucleo::all();
        $nucleoslist = Nucleo::orderBy('nome')->paginate(10);
        Session::put('quant', 'Foram encontrados '.count($nucleoall).' núcleos no banco de dados.');

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
        $dataForm = array_filter($request->all());
        $nucleoslist = Nucleo::where(function($query) use($dataForm){
            if(array_key_exists('nome', $dataForm)){
                $filtro = $dataForm['nome'];
                $query->where('nome', 'like', $filtro."%");
            }
            if(array_key_exists('inativo', $dataForm)){
                $filtro = $dataForm['inativo'];
                $query->where('inativo', '=', $filtro);
            }
            if(array_key_exists('bairro', $dataForm)){
                $filtro = $dataForm['bairro'];
                $query->where('bairro', 'like', $filtro."%");
            }
            if(array_key_exists('rua', $dataForm)){
                $filtro = $dataForm['rua'];
                $query->where('rua', 'like', $filtro."%");
            }
            if(array_key_exists('numero_endereco', $dataForm)){
                $filtro = $dataForm['numero_endereco'];
                $query->where('numero_endereco', 'like', $filtro."%");
            }
            if(array_key_exists('cep', $dataForm)){
                $filtro = $dataForm['cep'];
                $query->where('cep', 'like', $filtro."%");
            }
        })->orderBy('nome')->paginate(10);
        Session::put('quant', 'Foram encontrados '.count($nucleoslist).' núcleos no banco de dados.');
            
        return view ('nucleos_file.nucleos', compact('nucleoslist'));
    }
}
