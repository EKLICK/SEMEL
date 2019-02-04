<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use App\Http\Requests\Pessoa\PessoaCreateFormRequest;
use App\Http\Requests\Pessoa\PessoaEditFormRequest;
use App\Http\Requests\Pessoa\PessoaProcurarFormRequest;
use App\Pessoa;
use App\Nucleo;
use App\Doenca;
use App\Turma;
use App\Anamnese;
use App\HistoricoPT;

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

    public function checar_estado($listadados, $nascimento){
        if($listadados['img_3x4'] == null){return 0;}
        if($listadados['rg'] == null){return 0;}
        if($nascimento >= 18){
            if($listadados['cpf'] == null){return 0;}
        }
        if($listadados['bairro_id'] == null){return 0;}
        if($listadados['rua'] == null){return 0;}
        if($listadados['numero_endereco'] == null){return 0;}
        if($listadados['complemento'] == null){return 0;}
        if($listadados['cep'] == null){return 0;}
        if($listadados['telefone'] == null){return 0;}
        if($listadados['telefone_emergencia'] == null){return 0;}
        if($listadados['convenio_medico'] == null){return 0;}
        if($listadados['pessoa_emergencia'] == null){return 0;}
        if($listadados['estado_civil'] == null){return 0;}
        if($listadados['mora_com_os_pais'] == null){return 0;}
        if($nascimento < 18){
            if($listadados['img_matricula'] == null){return 0;}
            if($listadados['cpf_responsavel'] == null){return 0;}
        }
        return 1;
    }

    public function mostrar_nascimento($data, $opcao){
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $dia_hora = explode(' ', $data);
        list($ano, $mes, $dia) = explode('-', $dia_hora[0]);
        if($opcao == 1){
            $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);
            $data = (int)floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);;
        }
        else{
            $data = $dia.'/'.$mes.'/'.$ano;
        }
        return $data;
    }
    
    //Funções de Redirecionamento
    public function index()
    {
        $pessoaslist = Pessoa::orderBy('nome')->paginate(10);
        foreach($pessoaslist as $pessoa){
           $pessoa['nascimento'] = $this->mostrar_nascimento($pessoa['nascimento'], 1);
        }
        $ano = date('Y');
        $pessoall = Pessoa::all();
        $bairroslist = ['ARROIO DA MANTEIGA','BOA VISTA','CAMPESTRE','CAMPINA','CENTRO','CRISTO REI','DUQUE DE CAXIAS',
                        'FAZENDA SAO BORJA','FEITORIA','FIAO','JARDIM AMERICA','MORRO DO ESPELHO','PADRE REUS','PINHEIRO',
                        'RIO BRANCO','RIO DOS SINOS','SANTA TEREZA','SANTO ANDRE','SANTOS DUMONT','SAO JOAO BATISTA',
                        'SAO JOSE','SAO MIGUEL','SCHARLAU','VICENTINA'];
        Session::put('quant', count($pessoall).' pessoas cadastradas.');

        return view ('pessoas_file.pessoas', compact('pessoaslist','bairroslist','ano'));
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
        $bairroslist = ['ARROIO DA MANTEIGA','BOA VISTA','CAMPESTRE','CAMPINA','CENTRO','CRISTO REI','DUQUE DE CAXIAS',
                        'FAZENDA SAO BORJA','FEITORIA','FIAO','JARDIM AMERICA','MORRO DO ESPELHO','PADRE REUS','PINHEIRO',
                        'RIO BRANCO','RIO DOS SINOS','SANTA TEREZA','SANTO ANDRE','SANTOS DUMONT','SAO JOAO BATISTA',
                        'SAO JOSE','SAO MIGUEL','SCHARLAU','VICENTINA'];
        return view ('pessoas_file.pessoas_create', compact('doencaslist','bairroslist'));
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
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        list($dia, $mes, $ano) = explode('/', $dataForm['nascimento']);
        $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);
        $nascimento = (int)floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
        $errors = [];
        if($nascimento > 18){
            $dataForm['img_matricula'] = null;
            $dataForm['cpf_responsavel'] = null;
        }
        else{
            if(isset($dataForm['img_3x4'])){$dataForm['img_matricula'] = $this->saveDbImageMatricula($request);}
            else{$dataForm['img_matricula'] = null;}
        }
        if(isset($dataForm['marc'])){
            if($dataForm['marc'] == 'N'){
                $dataForm['convenio_medico'] = -1;
            }
        }
        if(isset($dataForm['img_3x4'])){$dataForm['img_3x4'] = $this->saveDbImage3x4($request);}
        else{$dataForm['img_3x4'] = null;}
        if(!isset($dataForm['bairro_id'])){$dataForm['bairro_id'] = null;}
        if(!isset($dataForm['estado_civil'])){$dataForm['estado_civil'] = null;}
        if(!isset($dataForm['mora_com_os_pais'])){$dataForm['mora_com_os_pais'] = null;}
        if(!isset($dataForm['toma_medicacao'])){$dataForm['toma_medicacao'] = null;}
        if(!isset($dataForm['alergia_medicacao'])){$dataForm['alergia_medicacao'] = null;}
        if(!isset($dataForm['fumante'])){$dataForm['fumante'] = null;}
        if(!isset($dataForm['cirurgia'])){$dataForm['cirurgia'] = null;}
        if(!isset($dataForm['dor_muscular'])){$dataForm['dor_muscular'] = null;}
        if(!isset($dataForm['dor_articular'])){$dataForm['dor_articular'] = null;}
        if(!isset($dataForm['dor_ossea'])){$dataForm['dor_ossea'] = null;}
        
        $estado = $this->checar_estado($dataForm, $nascimento);
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
            'bairro_id' => $dataForm['bairro_id'],
            'numero_endereco' => $dataForm['numero_endereco'],
            'complemento' => $dataForm['complemento'],
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
            'estado' =>$estado,
        ]);
        if(!empty($dataForm['doencas'])){
            $dataForm['possui_doenca'] = 1;
        }
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
            'observacao' => $dataForm['observacao'],
            'ano' => date('Y'),
            'pessoas_id' => $pessoa->id,
        ]);
        if(isset($dataForm['doencas'])){
            $anamnese->doencas()->attach($dataForm['doencas']);
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
        $pessoa['nascimento'] = $this->mostrar_nascimento($pessoa['nascimento'], 2);
        $doencaslist = Doenca::all();
        $bairroslist = ['ARROIO DA MANTEIGA','BOA VISTA','CAMPESTRE','CAMPINA','CENTRO','CRISTO REI','DUQUE DE CAXIAS',
                        'FAZENDA SAO BORJA','FEITORIA','FIAO','JARDIM AMERICA','MORRO DO ESPELHO','PADRE REUS','PINHEIRO',
                        'RIO BRANCO','RIO DOS SINOS','SANTA TEREZA','SANTO ANDRE','SANTOS DUMONT','SAO JOAO BATISTA',
                        'SAO JOSE','SAO MIGUEL','SCHARLAU','VICENTINA'];

        return view ('pessoas_file.pessoas_edit', compact('doencaslist','bairroslist','pessoa'));
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
        if(isset($dataForm['img_3x4'])){
            if(!empty($pessoa['foto'])){
                unlink($pessoa['foto']);
            }
            $dataForm['img_3x4'] = $this->saveDbImage3x4($request);
        }
        elseif(!empty($pessoa['foto'])){
            $dataForm += ['img_3x4' => $pessoa['foto']];
        }
        else{
            $dataForm += ['img_3x4' => null];
        }
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        list($dia, $mes, $ano) = explode('/', $dataForm['nascimento']);
        $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);
        $nascimento = (int)floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
        if($nascimento > 18){
            $dataForm['img_matricula'] = null;
            $dataForm['cpf_responsavel'] = null;
        }
        else{
            if(isset($dataForm['img_matricula'])){
                if(!empty($pessoa['matricula'])){
                    unlink($pessoa['matricula']);
                }
                $dataForm['img_matricula'] = $this->saveDbImageMatricula($request);
            }
            elseif(!empty($pessoa['matricula'])){
                $dataForm += ['img_matricula' => $pessoa['matricula']];
            }
            else{
                $dataForm += ['img_matricula' => null];
            }
        }
        if($dataForm['marc'] == 'N'){
            $dataForm['convenio_medico'] = -1;
        }
        $estado = $this->checar_estado($dataForm, $nascimento);
        $nascimento = explode('/', $dataForm['nascimento']);
        $dataForm['nascimento'] = $nascimento[2].'-'.$nascimento[1].'-'.$nascimento[0];
        if(!isset($dataForm['bairro_id'])){$dataForm['bairro_id'] = null;}
        if(!isset($dataForm['estado_civil'])){$dataForm['estado_civil'] = null;}
        if(!isset($dataForm['mora_com_os_pais'])){$dataForm['mora_com_os_pais'] = null;}
        $pessoa->update([
            'foto' => $dataForm['img_3x4'],
            'nome' => $dataForm['nome'],
            'nascimento' => $dataForm['nascimento'],
            'sexo' => $dataForm['sexo'],
            'rg' => $dataForm['rg'],
            'cpf' => $dataForm['cpf'],
            'cpf_responsavel' => $dataForm['cpf_responsavel'],
            'cidade' => $dataForm['cidade'],
            'rua' => $dataForm['rua'],
            'bairro_id' => $dataForm['bairro_id'],
            'numero_endereco' => $dataForm['numero_endereco'],
            'complemento' => $dataForm['complemento'],
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
            'estado' => $estado,
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
        foreach($pessoa->turmas as $turma){
            $pessoa->turmas()->detach($turma->id);
        }
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
        $anamnese = $pessoa->anamneses->last();
        $pessoa['nascimento'] = $this->mostrar_nascimento($pessoa['nascimento'], 2);
        $histpessoa = HistoricoPT::where('pessoa_id', '=', $pessoa->id)->paginate(5);
        $a = 0;
        $b = 0;
        $idsturmas = [];
        foreach($pessoa->turmas as $turma){
            array_push($idsturmas, $turma->nucleo_id);
            if($turma->pivot->inativo == 1){$b++;}
            $a++;
        }
        $c = $a - $b;
        $dadosgerais = [$a,$b,$c];
        $idsturmas = array_unique($idsturmas);
        $listnucleopessoa = Nucleo::whereIn('id', $idsturmas)->get();

        return view ('pessoas_file.pessoas_info', compact('pessoa', 'anamnese','histpessoa','dadosgerais','listnucleopessoa'));
    }

    public function pessoas_turmas($id){
        $pessoa = Pessoa::find($id);
        $turmaslist = Turma::orderBy('nome')->paginate(10);
        $turmasall = Turma::all();
        $dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];
        $nucleoslist = Nucleo::all();
        Session::put('quant', count($turmasall).' turmas cadastradas.');

        return view ('Pessoas_file.pessoas_turmas', compact('pessoa', 'turmaslist', 'pessoasTurmas', 'dias_semana', 'nucleoslist'));
    }

    public function pdfpessoas($id){
        $pessoa = Pessoa::find($id);
        if($pessoa == null){
            $pessoaslist = Pessoa::onlyTrashed()->get();
            $pessoa = $pessoaslist->find($id);
        }
        return \PDF::loadview('pdf_file.pessoas_pdf', compact('pessoa'))->stream('PDF_registro_pessoa'.'.pdf');
    }

    public function pessoas_turmas_vincular(Request $request){
        $dataForm = $request->all();
        $pessoa = Pessoa::withTrashed()->where('id', '=', $dataForm['pessoa_id'])->get()->last();
        $turma = Turma::find($dataForm['turma_id']);
        dd($turma);
        if($dataForm['inativo'] == 1){
            DB::update(DB::raw('update turmas set quant_atual = :quant where id = :turma'), ['quant'=>$turma->quant_atual+1, 'turma'=>$dataForm['turma_id']]);
        }
        $pessoa->turmas()->attach($turma->id, ['inativo'=>$dataForm['inativo']]);
        $historico = HistoricoPT::create($dataForm);
        if($turma->quant_atual+1 > $turma->limite){
            Session::put('mensagem_yellow', "A turma " . $turma->nome . " está além de seu limite máximo!");
        }
        else{
            Session::put('mensagem_green', $pessoa->nome . " foi vinculado a turma" . $turma->nome ." com sucesso!");
        }

        return redirect()->Route('pessoas_turmas', $pessoa->id);
    }

    public function pessoas_turmas_ativar_inativar(Request $request){
        dd('ff');
        $dataForm = $request->all();
        $turma = Turma::find($dataForm['turma_id']);
        $aux = -1;
        for($i = 0; $i < count($turma->pessoas); $i++){
            if($turma->pessoas[$i]->id == $dataForm['pessoa_id']){
                $aux = $i;
            }
        }
        $string = '';
        $texto = '';
        $conta = 0;
        if($turma->pessoas[$aux]->pivot->inativo == 1){
            DB::update(DB::raw('update turmas set quant_atual = :quant where id = :turma'), ['quant'=>$turma->quant_atual-1, 'turma'=>$turma->id]);
            $string = 'update turmas_pessoas set inativo = 2 where pessoa_id = :sujeito and turma_id = :turma';
            $texto = ' foi adicionado a turma ';
            $conta = $turma->quant_autal-1;
            HistoricoPT::create([
                'pessoa_id' => $dataForm['pessoa_id'],
                'turma_id' => $dataForm['turma_id'],
                'comentario' => $dataForm['comentario'],
                'inativo' => 2,
                
            ]);
        }
        else{
            DB::update(DB::raw('update turmas set quant_atual = :quant where id = :turma'), ['quant'=>$turma->quant_atual+1, 'turma'=>$turma->id]);
            $string = 'update turmas_pessoas set inativo = 1 where pessoa_id = :sujeito and turma_id = :turma';
            $texto = ' foi removido a turma ';
            $conta = $turma->quant_autal+1;
            HistoricoPT::create([
                'pessoa_id' => $dataForm['pessoa_id'],
                'turma_id' => $dataForm['turma_id'],
                'comentario' => $dataForm['comentario'],
                'inativo' => 1,
            ]);
        }
        DB::update(DB::raw($string), ['sujeito'=>$dataForm['pessoa_id'], 'turma'=>$dataForm['turma_id']]);
        $pessoa = Pessoa::find($dataForm['pessoa_id']);

        if($conta > $turma->limite){
            Session::put('mensagem_yellow', "A turma " . $turma->nome . " está além de seu limite máximo!");
        }
        else{
            Session::put('mensagem_green', $pessoa->nome . $texto . $turma->nome ." com sucesso!");
        }

        return redirect()->Route('pessoas_turmas', $pessoa->id);
    }
}