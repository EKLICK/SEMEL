<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use App\Http\Requests\Pessoa\PessoaCreateFormRequest;
use App\Http\Requests\Pessoa\PessoaEditFormRequest;
use App\Pessoa;
use App\Doenca;
use App\Turma;
use App\Anamnese;

class PessoasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Funções ferramentas
    public function filtrar_ano($pessoasnalista, $anofiltro, $option){
        $pessoasfiltradas = [];
        foreach($pessoasnalista as $pessoanalista){
            list($dia, $mes, $ano) = explode('/', $pessoanalista['nascimento']);
            $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);
            $idade = (int)floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
            if($option == 1){
                if($idade >= $anofiltro){
                    array_push($pessoasfiltradas, $pessoanalista);
                }
                if($dia.'/'.$mes == '29/02' && (date('Y')/4 == 0 && date('Y')/100 != 0)){
                    array_pust($pessoasfiltradas, $pessoanalista);
                }
            }
            else{
                if($idade <= $anofiltro){
                    array_push($pessoasfiltradas, $pessoanalista);
                }
                if($dia.'/'.$mes == '29/02' && (date('Y')/4 == 0 && date('Y')/100 != 0)){
                    array_pust($pessoasfiltradas, $pessoanalista);
                }
            }
        }

        return $pessoasfiltradas;
    }

    public function saveDbImage3x4($req){
        $data = $req->all();
        $imagem = $req->file('img_3x4');
        $num = rand(1111, 9999);
        $dir = "img/img_3x4";
        $ex = $imagem->guessClientExtension();
        $nomeImagem = "imagem_".$num.".".$ex;
        $imagem->move($dir, $nomeImagem);
        $data['img_3x4'] = $dir."/".$nomeImagem;
        return $data['img_3x4'];
    }

    public function saveDbImageMatricula($req){
        $data = $req->all();
        $imagem = $req->file('img_matricula');
        $num = rand(1111, 9999);
        $dir = "img/img_matricula";
        $ex = $imagem->guessClientExtension();
        $nomeImagem = "imagem_".$num.".".$ex;
        $imagem->move($dir, $nomeImagem);
        $data['img_matricula'] = $dir."/".$nomeImagem;
        return $data['img_matricula'];
    }
    
    //Funções de Redirecionamento
    public function index()
    {
        $pessoaslist = Pessoa::orderBy('nome')->paginate(10);
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        foreach($pessoaslist as $pessoa){
            $dia_hora = explode(' ', $pessoa['nascimento']);
            list($ano, $mes, $dia) = explode('-', $dia_hora[0]);
            $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);
            $pessoa['nascimento'] = (int)floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);;
        }
        $data = new \DateTime();
        $ano = date('Y');
        $pessoall = Pessoa::all();
        Session::put('quant', 'Foram encontrados '.count($pessoall).' pessoas no banco de dados.');

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
    
    public function store(PessoaCreateFormRequest $request)
    {
        $dataForm = $request->all();
        $escolha = $dataForm['escolha'];
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        list($dia, $mes, $ano) = explode('/', $dataForm['nascimento']);
        $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);
        $nascimento = (int)floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
        if($escolha == 1 && $nascimento > 18){
            $errors = new MessageBag();
            $errors->add('idade', 'É necessario idade menor que 18 anos para menores de idade!');
            $doencaslist = Doenca::all();

            return view ('pessoas_file.pessoas_create_file.pessoas_create_menores', compact('doencaslist'))->withErrors();
        }
        elseif($escolha == 2 && $nascimento < 18){
            $errors = new MessageBag();
            $errors->add('idade', 'É necessario idade maior que 18 anos para maiores de idade!');
            $doencaslist = Doenca::all();
            return view ('pessoas_file.pessoas_create_file.pessoas_create_maiores', compact('doencaslist'));
        }
        dd('fd');
        unset($dataForm['escolha']);
        $dataForm['img_3x4'] = $this->saveDbImage3x4($request);
        if($escolha == 1 && $dataForm['img_matricula'] != null){
            $dataForm['img_matricula'] = $this->saveDbImageMatricula($request);
        }
        else{
            $pessoalist = Pessoa::all();
            foreach($pessoalist as $pessoa){
                if($pessoa['cpf'] == $dataForm['cpf']){
                    Session::put('mensagem', 'Erro, CPF já registrado no banco de dados!');
                    return redirect()->route('pessoas_maiores');
                }
                if($pessoa['rg'] == $dataForm['rg']){
                    Session::put('mensagem', 'Erro, RG já registrado no banco de dados!');
                    return redirect()->route('pessoas_maiores');
                }
            }
            $dataForm['cpf_responsavel'] = null;
            $dataForm['img_matricula'] = null;
        }
        $nascimento = explode('/', $dataForm['nascimento']);
        $dataForm['nascimento'] = $nascimento[2].'-'.$nascimento[1].'-'.$nascimento[0];
        $pessoa = Pessoa::create([
            'foto' => $dataForm['img_3x4'],
            'nome' => $dataForm['nome'],
            'nascimento' => $dataForm['nascimento'],
            'sexo' => $dataForm['sexo'],
            'rg' => $dataForm['rg'],
            'cpf' => $dataForm['cpf'],
            'cpf_responsavel' => $dataForm['cpf_responsavel'],
            'cidade' => $dataForm['cidade'],
            'rua' => $dataForm['rua'],
            'bairro' => $dataForm['bairro'],
            'numero_endereco' => $dataForm['numero_endereco'],
            'cep' => $dataForm['cep'],
            'telefone' => $dataForm['telefone'],
            'telefone_emergencia' => $dataForm['telefone_emergencia'],
            'estado_civil' => $dataForm['estado_civil'],
            'nome_do_pai' => $dataForm['nome_do_pai'],
            'nome_da_mae' => $dataForm['nome_da_mae'],
            'pessoa_emergencia' => $dataForm['pessoa_emergencia'],
            'filhos' => $dataForm['filhos'],
            'convenio_medico' => $dataForm['convenio_medico'],
            'irmao' => $dataForm['irmaos'],
            'mora_com_os_pais' => $dataForm['mora_com_os_pais'],
            'matricula' => $dataForm['img_matricula'],
        ]);
        unset($dataForm['img_3x4']);
        if($escolha == 1){
            unset($dataForm['img_matricula']);
        }
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
        
        $dataForm += ['ano' => date('Y')];
        $dataForm += ['pessoas_id' => $pessoa->id];

        if(!empty($dataForm['doencas'])){
            $dataForm['possui_doenca'] = 1;
        }
        if(isset($dataForm['doencas'])){
            $anamnese = Anamnese::create([
                'possui_doenca' => $dataForm['possui_doenca'],
                'toma_medicacao' => $dataForm['toma_medicacao'],
                'alergia_medicacao' => $dataForm['alergia_medicacao'],
                'peso' => $dataForm['peso'],
                'altura' => $dataForm['altura'],
                'fumante' => $dataForm['fumante'],
                'cirurgia' => $dataForm['cirurgia'],
                'dor_muscular' => $dataForm['dor_muscular'],
                'dor_articular' => $dataForm['dor_articular'],
                'dor_ossea' => $dataForm['dor_ossea'],
                'atestado' => $dataForm['atestado'],
                'observacao' => $dataForm['observacao']
            ]);
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
        $dia_hora = explode(' ', $pessoa['nascimento']);
        list($ano, $mes, $dia) = explode('-', $dia_hora[0]);
        $pessoa['nascimento'] = $dia.'/'.$mes.'/'.$ano;
        $doencaslist = Doenca::all();

        return view ('pessoas_file.pessoas_edit', compact('doencaslist', 'pessoa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PessoaEditFormRequest $request, $id)
    {
        $pessoa = Pessoa::find($id);
        $dataForm = $request->all();
        $escolha = $dataForm['escolha'];
        if($dataForm['img_3x4'] != $pessoa['foto']){
            if(!empty($pessoa['foto'])){
                unlink($pessoa['foto']);
            }
            $dataForm['img_3x4'] = $this->saveDbImage3x4($request);
        }
        if($escolha == 1){
            if($dataForm['img_matricula'] != $pessoa['matricula']){
                if(!empty($pessoa['matricula'])){
                    unlink($pessoa['matricula']);
                }
                $dataForm['img_matricula'] = $this->saveDbImageMatricula($request);
            }
        }
        else{
            $dataForm['img_matricula'] = null;
        }
        $nascimento = explode('/', $dataForm['nascimento']);
        $dataForm['nascimento'] = $nascimento[2].'-'.$nascimento[1].'-'.$nascimento[0];
        $pessoa->update([
            'foto' => $dataForm['img_3x4'],
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
            'telefone_emergencia' => $dataForm['telefone_emergencia'],
            'estado_civil' => $dataForm['estado_civil'],
            'nome_do_pai' => $dataForm['nome_do_pai'],
            'nome_da_mae' => $dataForm['nome_da_mae'],
            'pessoa_emergencia' => $dataForm['pessoa_emergencia'],
            'filhos' => $dataForm['filhos'],
            'convenio_medico' => $dataForm['convenio_medico'],
            'irmao' => $dataForm['irmaos'],
            'mora_com_os_pais' => $dataForm['mora_com_os_pais'],
            'matricula' => $dataForm['img_matricula'], 
        ]);

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
        Session::put('quant', 'Foram encontradas '. count($pessoa->anamneses).' anamneses de '. $pessoa->nome);

        return view ('Pessoas_file.pessoas_lista_anamnese', compact('anamneses', 'pessoa', 'ano'));
    }

    public function lista_anamnese_create($id){
        return redirect()->Route('anamnese_create', $id);
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

        $pessoaslist = Pessoa::where(function($query) use($dataForm){
            if(!empty($dataForm['nome'])){
                $filtro = $dataForm['nome'];
                $query->where('nome', 'like', $filtro."%");
            }
            if(!empty($dataForm['de'])){
                $filtro = explode(' ',$dataForm['de']);
                list($dia, $mes, $ano) = explode('/', $filtro[0]);
                $nascimento = $ano.'-'.$mes.'-'.$dia.' 00:00:00';
                $query->where('nascimento',  '>=', $nascimento);
            }
            if(!empty($dataForm['ate'])){
                $filtro = explode(' ',$dataForm['ate']);
                list($dia, $mes, $ano) = explode('/', $filtro[0]);
                $nascimento = $ano.'-'.$mes.'-'.$dia.' 00:00:00';
                $query->where('nascimento',  '<=', $nascimento);
            }
            if(!empty($dataForm['rg'])){
                $filtro = $dataForm['rg'];
                $query->where('rg', 'like', $filtro."%");
            }
            if(!empty($dataForm['cpf'])){
                $filtro = $dataForm['cpf'];
                $query->where('cpf', 'like', $filtro."%");
            }
            if(!empty($dataForm['bairro'])){
                $filtro = $dataForm['bairro'];
                $query->where('bairro', 'like', $filtro."%");
            }
            if(!empty($dataForm['rua'])){
                $filtro = $dataForm['rua'];
                $query->where('rua', 'like', $filtro."%");
            }
            if(!empty($dataForm['telefone'])){
                $filtro = $dataForm['telefone'];
                $query->where('telefone', 'like', $filtro."%");
            }
            if(!empty($dataForm['sexo'])){
                $filtro = $dataForm['sexo'];
                $query->where('sexo', '=', $filtro);
            }
            if(!empty($dataForm['estado_civil'])){
                $filtro = $dataForm['estado_civil'];
                $query->where('estado_civil', '=', $filtro);
            }
        })->orderBy('nome')->paginate(10);
        Session::put('quant', 'Foram encontrados '.count($pessoaslist).' pessoas no banco de dados.');
        $ano = date('Y');

        return view ('pessoas_file.pessoas', compact('pessoaslist', 'ano'));
    }
}