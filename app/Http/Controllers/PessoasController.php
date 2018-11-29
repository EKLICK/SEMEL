<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pessoa;
use App\Turma;
use App\Anamnese;
use Illuminate\Support\Facades\Session;

class PessoasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pessoaslist = Pessoa::orderBy('nome')->paginate(10);
        $data = new \DateTime();
        $ano = date('Y');

        return view ('pessoas_file.pessoas', compact('pessoaslist', 'ano'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('pessoas_file.pessoas_create');
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
        $pessoa =  Pessoa::create($dataForm);
        Session::put('pessoa', $pessoa->id);
        Session::put('mensagem', $pessoa->nome.' editado(a) com sucesso!');

        return redirect()->Route('anamneses.create');
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
        $pessoa = Pessoa::find($id);

        return view ('pessoas_file.pessoas_edit', compact('pessoa'));
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
        $pessoa = Pessoa::find($id);
        $dataForm = $request->all();
        $oldpessoa = (array)$pessoa;
        $pessoa->update($dataForm);
        $newpessoa = (array)$pessoa;
        if($newpessoa != $oldpessoa){
            Session::put('mensagem', $pessoa->nome.' editado(a) com sucesso!');
        }

        return redirect()->Route('pessoas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $pessoa = Pessoa::find($request['id']);
        $nome = $pessoa->nome;
        $pessoa->delete();
        Session::put('mensagem', $nome.' deletado(a) com sucesso!');

        return redirect()->Route('pessoas.index');
    }

    public function lista_anamnese($id){
        $anamneses = Anamnese::where('pessoas_id', '=', $id)->orderBy('ano', 'desc')->paginate(10);
        $pessoa = Pessoa::find($id);
        if($pessoa == null){
            $pessoaslist = Pessoa::onlyTrashed()->get();
            $pessoa = $pessoaslist->find($id);
        }
        $ano = date('Y');

        return view ('Pessoas_file.pessoas_lista_anamnese', compact('anamneses', 'pessoa', 'ano'));
    }

    public function lista_anamnese_create($id){
        Session::put('pessoa', $id);

        return redirect()->Route('anamneses.create');
    }

    public function pessoas_info($id){
        $pessoa = Pessoa::find($id);
        if($pessoa == null){
            $pessoaslist = Pessoa::onlyTrashed()->get();
            $pessoa = $pessoaslist->find($id);
        }
        $anamnese = $pessoa->anamneses->last();

        return view ('pessoas_file.pessoas_info', compact('pessoa', 'anamnese'));
    }

    public function pessoas_turmas($id){
        $turmas = Turma::all();
        $pessoa = Pessoa::find($id);
        foreach($pessoa->turmas as $p){
            $pessoasTurmas[] = $p->id;
        }

        return view ('Pessoas_file.pessoas_turmas', compact('pessoa', 'turmas', 'pessoasTurmas'));
    }

    public function pessoas_turmas_vincular($idpessoa, $idturma){
        $pessoa = Pessoa::find($idpessoa);
        $turma = Turma::find($idturma);
        $pessoa->turmas()->attach($idturma);
        if(count($turma->pessoas) > $turma->limite){
            Session::put('mensagem_yellow', "A turma " . $turma->nome . " está além de seu limite máximo!");
        }
        else{
            Session::put('mensagem_green', $pessoa->nome . " foi adicionado a turma" . $turma->nome ." com sucesso!");
        }

        return redirect()->Route('pessoas_turmas', $pessoa->id);
    }

    public function pessoas_turmas_desvincular($idpessoa, $idturma){
        $pessoa = Pessoa::find($idpessoa);
        $pessoa->turmas()->detach($idturma);

        return redirect()->Route('pessoas_turmas', $pessoa->id);
    }

    public function softdeletes(){
        $pessoaslist = Pessoa::onlyTrashed()->paginate(10);
        $data = new \DateTime();
        $ano = date('Y');
        
        return view ('pessoas_file.pessoas_softdeletes', compact('pessoaslist', 'ano'));
    }

    public function restore($id){
        $pessoaslist = Pessoa::onlyTrashed()->get();
        $pessoa = $pessoaslist->find($id);

        $pessoa->restore();

        return redirect()->route('pessoas.index');
    }

    public function pdfpessoas($id){
        $pessoa = Pessoa::find($id);
        if($pessoa == null){
            $pessoaslist = Pessoa::onlyTrashed()->get();
            $pessoa = $pessoaslist->find($id);
        }
        return \PDF::loadview('pdf_file.pessoas_pdf', compact('pessoa'))->stream('PDF_registro_pessoa'.'.pdf');
    }
}
