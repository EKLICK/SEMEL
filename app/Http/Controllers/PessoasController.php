<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pessoa;
use App\Doenca;
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

    //protected privadas
    public function filtrar($arraylists, $arrayfiltros){
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
    
    //public variaveis
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

    public function deletarPessoaCriada($id){
        Session::forget('mensagem');
        $pessoa = Pessoa::find($id);
        $pessoa->remove();

        return redirect()->route('pessoa.create');
    }

    public function create()
    {
        $doencaslist = Doenca::all();

        return view ('pessoas_file.pessoas_create', compact('doencaslist'));
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
        $pessoa = Pessoa::create([
            'nome' => $dataForm['nome'],
            'nascimento' => $dataForm['nascimento'],
            'sexo' => $dataForm['sexo'],
            'rg' => $dataForm['rg'],
            'cpf' => $dataForm['cpf'],
            'cidade' => $dataForm['cidade'],
            'endereco' => $dataForm['endereco'],
            'bairro' => $dataForm['bairro'],
            'cep' => $dataForm['cep'],
            'telefone' => $dataForm['telefone'],
            'estado_civil' => $dataForm['estado_civil'],
            'nome_do_pai' => $dataForm['nome_do_pai'],
            'nome_da_mae' => $dataForm['nome_da_mae'],
            'pessoa_emergencia' => $dataForm['pessoa_emergencia'],
            'filhos' => $dataForm['filhos'],
            'convenio_medico' => $dataForm['convenio_medico'],
            'irmao' => $dataForm['irmaos'],
            'mora_com_os_pais' => $dataForm['mora_com_os_pais'],
            'inativo' => $dataForm['inativo'],
        ]);

        unset($dataForm['nome']);
        unset($dataForm['nascimento']);
        unset($dataForm['sexo']);
        unset($dataForm['rg']);
        unset($dataForm['cpf']);
        unset($dataForm['cidade']);
        unset($dataForm['endereco']);
        unset($dataForm['bairro']);
        unset($dataForm['cep']);
        unset($dataForm['telefone']);
        unset($dataForm['telefone_emergencia']);
        unset($dataForm['estado_civil']);
        unset($dataForm['nome_do_pai']);
        unset($dataForm['nome_da_mae']);
        unset($dataForm['pessoa_emergencia']);
        unset($dataForm['filhos']);
        unset($dataForm['convenio_medico']);
        unset($dataForm['irmaos']);
        unset($dataForm['mora_com_os_pais']);
        unset($dataForm['inativo']);
        
        $dataForm += ['ano' => date('Y')];
        $dataForm += ['pessoas_id' => $pessoa->id];

        if(!empty($dataForm['doencas'])){
            $dataForm['possui_doenca'] = 1;
        }
        if(isset($dataForm['doencas'])){
            $anamnese = Anamnese::create($dataForm);;
            $anamnese->doencas()->attach($dataForm['doencas']);
        }else{
            Anamnese::create($dataForm);
        }
        Session::put('pessoa', $pessoa->id);
        Session::put('mensagem', $pessoa->nome.' criado(a) com sucesso!');

        return redirect()->Route('pessoas.index');
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

        return redirect()->Route('pessoas.index', 'pessoa', 'dataForm');
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

    public function pessoas_procurar(Request $request){
        $dataForm = $request->all();
        $pessoaslist = Pessoa::all();
        if($dataForm['nome'] != null){
            $pessoasnome = Pessoa::where('nome', 'like', $dataForm['nome'])->get();
            $pessoaslist = $this->filtrar($pessoaslist, $pessoasnome);
        }
        if($dataForm['de'] != null){
            foreach($pessoaslist as $pessoa){
                list($dia, $mes, $ano) = explode('/', $pessoa['nascimento']);
                $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);
                $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
                dd($idade);
            }
        }
        $data = new \DateTime();
        $ano = date('Y');

        return view ('pessoas_file.pessoas', compact('pessoaslist', 'ano'));
    }
}
