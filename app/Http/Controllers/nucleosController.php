<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\Nucleo\NucleoCreateEditFormRequest;
use App\Http\Requests\Nucleo\NucleoProcurarFormRequest;
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
    public function store(NucleoCreateEditFormRequest $request)
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
    public function update(NucleoCreateEditFormRequest $request, $id)
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

    public function nucleos_procurar(NucleoProcurarFormRequest $request){
        $dataForm = $request->all();
        $nucleoslist = Nucleo::where(function($query) use($dataForm){
            if(!empty($dataForm['nome'])){
                $filtro = $dataForm['nome'];
                $query->where('nome', 'like', $filtro."%");
            }
            if(!empty($dataForm['inativo'])){
                $filtro = $dataForm['inativo'];
                $query->where('inativo', '=', $filtro);
            }
            if(!empty($dataForm['bairro'])){
                $filtro = $dataForm['bairro'];
                $query->where('bairro', 'like', $filtro."%");
            }
            if(!empty($dataForm['rua'])){
                $filtro = $dataForm['rua'];
                $query->where('rua', 'like', $filtro."%");
            }
            if(!empty($dataForm['numero_endereco'])){
                $filtro = $dataForm['numero_endereco'];
                $query->where('numero_endereco', 'like', $filtro."%");
            }
            if(!empty($dataForm['cep'])){
                $filtro = $dataForm['cep'];
                $query->where('cep', 'like', $filtro."%");
            }
        })->orderBy('nome');
        Session::put('quant', 'Foram encontrados '.count($nucleoslist->get()).' núcleos no banco de dados.');
        $nucleoslist = $nucleoslist->paginate(10);
        return view ('nucleos_file.nucleos', compact('nucleoslist','dataForm'));
    }
}
