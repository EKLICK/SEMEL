<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\Professor\PessoaProcurarFormRequest;
use App\Http\Requests\Professor\ProfessorProcurarFormRequest;
use App\Http\Requests\Professor\AnamneseProcurarFormRequest;
use App\Http\Requests\Professor\AlunoProcurarFormRequest;
use App\Http\Requests\Professor\NucleoProcurarFormRequest;
use App\Http\Requests\Turma\TurmaProcurarFormRequest;
use Illuminate\Validation\Rule;
use App\User;
use App\Professor;
use App\Anamnese;
use App\Doenca;
use App\Turma;
use App\Nucleo;
use App\Pessoa;
use Illuminate\Support\Facades\Session;

class FiltersController extends Controller
{
    public function pessoas_procurar(PessoaProcurarFormRequest $request){
        $dataForm = $request->except('_token');
        
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
            if(!empty($dataForm['bairro_id'])){
                $filtro = $dataForm['bairro_id'];
                $query->where('bairro_id', '=', $filtro);
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
        })->orderBy('nome');
        $bairroslist = Bairro::all();
        Session::put('quant', 'Foram encontrados '.count($pessoaslist->get()).' pessoas no banco de dados.');
        $pessoaslist = $pessoaslist->paginate(10);
        $ano = date('Y');

        return view ('pessoas_file.pessoas', compact('pessoaslist','bairroslist', 'ano', 'dataForm'));
    }

    public function professor_procurar(ProfessorProcurarFormRequest $request){
        $dataForm = $request->except('_token');
        $professoreslist = Professor::where(function($query) use($dataForm){
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
            if(!empty($dataForm['email'])){
                $filtro = $dataForm['email'];
                $useremails = User::all()->where('email', 'like', $filtro)->where('admin_professor', '=', 0)->last();
                $query->where('user_id', '=', $useremails->id);
            }
            if(!empty($dataForm['matricula'])){
                $filtro = $dataForm['matricula'];
                $query->where('matricula', 'like', $filtro."%");
            }
            if(!empty($dataForm['telefone'])){
                $filtro = $dataForm['telefone'];
                $query->where('telefone', 'like', $filtro."%");
            }
            if(!empty($dataForm['bairro'])){
                $filtro = $dataForm['bairro'];
                $query->where('bairro', 'like', $filtro."%");
            }
            if(!empty($dataForm['rua'])){
                $filtro = $dataForm['rua'];
                $query->where('rua', 'like', $filtro."%");
            }
        })->orderBy('nome');
        $count = count($professoreslist->get());
        $professoreslist = $professoreslist->paginate(10);
        Session::put('quant', 'Foram encontrados '.$count.' professores no banco de dados.');

        return view ('professores_file.professores', compact('professoreslist', 'turmaslist', 'dataForm'));
    }

    public function filtros_professor_turmas(TurmaProcurarFormRequest $request, $id){
        $dataForm = $request->except('_token');
        $professor = Professor::find($id);
        $turmas_professor = $professor->turmas->sortBy('nome');
        $turmaslist = Turma::where(function($query) use($dataForm){
            if(!empty($dataForm['nome'])){
                $filtro = $dataForm['nome'];
                $query->where('nome', 'like', "%".$filtro."%");
            }
            if(!empty($dataForm['inativo'])){
                $filtro = $dataForm['inativo'];
                $query->where('inativo', '=', $filtro."%");
            }
            if(!empty($dataForm['limite'])){
                $filtro = $dataForm['limite'];
                $query->where('limite', '=', $filtro);
            }
            if(!empty($dataForm['horario_inicial'])){
                $horario = explode(' ', $dataForm['horario_inicial']);
                if($horario[1] == 'PM'){
                    $separador = explode(':', $horario[0]);
                    $separador[0] = 12 + (int)$separador[0];
                    $horario[0] = $separador[0].':'.$separador[1];
                }
                $filtro = $horario[0].':00';
                $query->where('horario_inicial', '>=', $filtro);
            }
            if(!empty($dataForm['horario_final'])){
                $horario = explode(' ', $dataForm['horario_final']);
                if($horario[1] == 'PM'){
                    $separador = explode(':', $horario[0]);
                    $separador[0] = 12 + (int)$separador[0];
                    $horario[0] = $separador[0].':'.$separador[1];
                }
                $filtro = $horario[0].':00';
                $query->where('horario_final', '<=', $filtro);
            }
            if(!empty($dataForm['data_semanal'])){
                $filtro = $dataForm['data_semanal'];
                $query->where('horario_semanal', 'like', '%'.$filtro.'%');
            }
            if(!empty($dataForm['nucleo_id'])){
                $filtro = $dataForm['nucleo_id'];
                $query->where('nucleo_id', '=', $filtro);
            }
            if(auth()->user()->admin_professor == 0){
                $turmasall = Turma::all();
                $turmasids = [];
                $turmas_filtradas = $this->filtrar_dados($turmasall, $turmas_professor);
                foreach($turmas_filtradas as $turma_filtrada){
                    array_push($turmasids, $turma_filtrada->id);
                }
                $query->wherein('id', $turmasids);
            }
        })->orderBy('nome');
        Session::put('quant', 'Foram encontrados '.count($turmaslist->get()).' turmas no banco de dados.');
        $nucleoslist = Nucleo::orderBy('nome');
        $dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];
        $turmaslist = $turmaslist->paginate(10);
        if(auth()->user()->admin_professor == 1){
            foreach($professor->turmas as $turma){
                $professorTurmas[] = $turma->id;
            }
            return view ('professores_file.professores_turmas', compact('professor','turmaslist','professorTurmas','dias_semana','nucleoslist','dataForm'));
        }
        else{
            $professor = Professor::where('user_id', '=', auth()->user()->id)->first();
            return view ('professores_file.professores_turmas', compact('professor', 'turmaslist', 'dias_semana', 'nucleoslist','dataForm'));
        }
    }

    public function professor_procurar_aluno(AlunoProcurarFormRequest $request){
        $dataForm = $request->all();
        $professorid = $dataForm['professorid'];
        $turma = Turma::find($dataForm['idturma']);
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
            if(!empty($dataForm['telefone'])){
                $filtro = $dataForm['telefone'];
                $query->where('telefone', 'like', $filtro."%");
            }
            if(!empty($dataForm['sexo'])){
                $filtro = $dataForm['sexo'];
                $query->where('sexo', '=', $filtro);
            }
            $pessoasall = Pessoa::all();
            $turma = Turma::find($dataForm['idturma']);
            $pessoasids = [];
            $pessoas_filtradas = $this->filtrar_dados($pessoasall, $turma->pessoas);
            foreach($pessoas_filtradas as $pessoa_filtrada){
                array_push($pessoasids, $pessoa_filtrada->id);
            }
            $query->wherein('id', $pessoasids);
        })->orderBy('nome');
        Session::put('quant', 'Foram encontrados '.count($pessoaslist->get()).' pessoas no banco de dados.');
        $pessoaslist = $pessoaslist->paginate(10);

        return view ('professores_file.professores_meus_alunos', compact('turma','pessoaslist','professorid'));
    }

    public function turmas_procurar(TurmaProcurarFormRequest $request){
        $dataForm = $request->except('_token');
        
        $turmaslist = Turma::where(function($query) use($dataForm){
            if(!empty($dataForm['nome'])){
                $filtro = $dataForm['nome'];
                $query->where('nome', 'like', "%".$filtro."%");
            }
            if(!empty($dataForm['inativo'])){
                $filtro = $dataForm['inativo'];
                $query->where('inativo', '=', $filtro."%");
            }
            if(!empty($dataForm['limite'])){
                $filtro = $dataForm['nome'];
                $query->where('nome', 'like', $filtro."%");
            }
            if(!empty($dataForm['horario_inicial'])){
                $horario = explode(' ', $dataForm['horario_inicial']);
                if($horario[1] == 'PM'){
                    $separador = explode(':', $horario[0]);
                    $separador[0] = 12 + (int)$separador[0];
                    $horario[0] = $separador[0].':'.$separador[1];
                }
                $filtro = $horario[0].':00';
                $query->where('horario_inicial', '=', $filtro);
            }
            if(!empty($dataForm['horario_final'])){
                $horario = explode(' ', $dataForm['horario_final']);
                if($horario[1] == 'PM'){
                    $separador = explode(':', $horario[0]);
                    $separador[0] = 12 + (int)$separador[0];
                    $horario[0] = $separador[0].':'.$separador[1];
                }
                $filtro = $horario[0].':00';
                $query->where('horario_final', '=', $filtro);
            }
            if(!empty($dataForm['data_semanal'])){
                $filtro = '';
                foreach($dataForm['data_semanal'] as $data){
                    $filtro = $filtro.$data.',';
                }
                $query->where('data_semanal', 'like', '%'.$filtro.'%');
            }
            if(!empty($dataForm['nucleo_id'])){
                $filtro = $dataForm['nucleo_id'];
                $query->where('nucleo_id', '=', $filtro);
            }
        })->orderBy('nome');
        Session::put('quant', 'Foram encontrados '.count($turmaslist->get()).' turmas no banco de dados.');
        $nucleoslist = Nucleo::all();
        if(!empty($dataForm['pagina'])){
            $op = $dataForm['pagina'];
        }
        $dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];
        if($dataForm['id'] > 0){
            $turmaslist = $turmaslist->paginate(10);
            $professor = Professor::find($dataForm['id']);
            if($professor != null){
                $turmasprofessor = $professor->turmas;
            }
            Session::put('turmaslist', $turmaslist);

            return redirect()->route('filtros_professor_turmas', $dataForm['id'], 'dataForm');
        }
        elseif ($dataForm['id'] < 0) {
            $turmaslist = $turmaslist->paginate(10);
            $pessoa = Pessoa::find(-$dataForm['id']);
            foreach($pessoa->turmas as $turma){
                $pessoasTurmas[] = $turma->id;
            }

            return view ('pessoas_file.pessoas_turmas', compact('pessoa', 'turmaslist', 'pessoasTurmas', 'nucleoslist', 'dias_semana', 'dataForm'));
        }
        else{
            $turmaslist = $turmaslist->paginate(10);
            return view ('turmas_file.turmas', compact('turmaslist', 'nucleoslist', 'dias_semana', 'dataForm'));
        }
    }

    public function anamnese_procurar(AnamneseProcurarFormRequest $request){
        $dataForm = $request->except('_token');
        $data = new \DateTime();
        $anamneseslist = Anamnese::where(function($query) use($dataForm){
            if($dataForm['escolha'] == 0){
                $query->where('ano', '<', date('Y'))->get();
            }
            else{
                $query->where('ano', '=', date('Y'))->get();
            }
            if(!empty($dataForm['de_peso'])){
                $filtro = $dataForm['de_peso'];
                $query->where('peso', '>=', $filtro);
                dd($query->get());
            }
            if(!empty($dataForm['ate_peso'])){
                $filtro = $dataForm['ate_peso'];
                $query->where('peso', '<=', $filtro);
            }
            if(!empty($dataForm['de_altura'])){
                $filtro = $dataForm['de_altura'];
                $query->where('altura', '>=', $filtro);
            }
            if(!empty($dataForm['ate_altura'])){
                $filtro = $dataForm['ate_altura'];
                $query->where('altura', '<=', $filtro);
            }
            if(!empty($dataForm['toma_medicacao'])){
                $filtro = $dataForm['toma_medicacao'];
                $query->where('toma_medicacao', '=', $filtro);
            }
            if(!empty($dataForm['cirurgia'])){
                $filtro = $dataForm['cirurgia'];
                $query->where('cirurgia', '=', $filtro);
            }
            if(!empty($dataForm['fumante'])){
                $filtro = $dataForm['fumante'];
                $query->where('fumante', '=', $filtro);
            }
            if(isset($dataForm['doencas'])){
                $anamnesesall = Anamnese::all();
                $anamnesesfiltradas = [];
                $anamnesesids = [];
                $anamnesesdoencas = [];
                foreach($anamnesesall as $anamnese){
                    $quant = 0;
                    foreach($anamnese['doencas'] as $doenca){
                        foreach($dataForm['doencas'] as $doencadalista){
                            if($doenca['id'] == $doencadalista){
                                $quant++;
                            }
                        }
                    }
                    if($quant == count($dataForm['doencas'])){
                        array_push($anamnesesdoencas, $anamnese);
                    }
                }
                $anamnesesfiltradas = $this->filtrar_dados($anamnesesall, $anamnesesdoencas);
                foreach($anamnesesfiltradas as $anamnesefiltrada){
                    array_Push($anamnesesids, $anamnesefiltrada->id);
                }
                $query->wherein('id', $anamnesesids);
            }
        })->orderBy('ano', 'desc');
        $ano = date('Y');
        Session::put('quant', 'Foram encontrados '.count($anamneseslist->get()).' anamneses de '.$ano.' no banco de dados.');
        $anamneseslist = $anamneseslist->paginate(10);
        $doencaslist = Doenca::all();
        if($dataForm['escolha'] == 0){
            return view ('anamneses_file.anamneses_antigas', compact('anamneseslist', 'ano', 'doencaslist','dataForm'));
        }
        else{
            return view ('anamneses_file.anamneses_atualizado', compact('anamneseslist', 'ano', 'doencaslist','dataForm'));
        }
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
            if(!empty($dataForm['bairro_id'])){
                $filtro = $dataForm['bairro_id'];
                $query->where('bairro_id', '=', $filtro);
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
        $bairroslist = Bairro::all();
        Session::put('quant', 'Foram encontrados '.count($nucleoslist->get()).' núcleos no banco de dados.');
        $nucleoslist = $nucleoslist->paginate(10);
        return view ('nucleos_file.nucleos', compact('nucleoslist','dataForm','bairroslist'));
    }

    public function doencas_procurar(Request $request){
        $dataForm = $request->all();
        $doencaslist = Doenca::all();
        if($dataForm['nome'] != null){
            $doencaslist = Doenca::orderBy('nome')->where('nome', 'like', $dataForm['nome'].'%');
        }
        Session::put('quant', 'Foram encontrados '.count($doencaslist->get()).' doenças no banco de dados.');
        $doencaslist = $doencaslist->paginate(10);
        return view ('doencas_file.doencas', compact('doencaslist','dataForm'));
    }

    public function audits_procurar(Request $request){
        $dataForm = $request->except('_token');
        $auditslist = Audit::where(function($query) use($dataForm){
            if(isset($dataForm['eventos'])){
                $i = $dataForm['eventos'];
                switch ($i[0]) {
                    case 0:
                        $query->where('event', '=', 'created')->get();
                        break;
                    case 1:
                        $query->where('event', '=', 'updated')->get();
                        break;
                    case 2:
                        $query->where('event', '=', 'delete')->get();
                        break;
                }
            }
            if(isset($dataForm['tabelas'])){
                $i = $dataForm['tabelas'];
                switch ($i[0]) {
                    case 0:
                        $query->where('auditable_type', '=', 'App\user')->get();
                        break;
                    case 1:
                        $query->where('auditable_type', '=', 'App\Professor')->get();
                        break;
                    case 2:
                        $query->where('auditable_type', '=', 'App\Pessoa')->get();
                        break;
                    case 3:
                        $query->where('auditable_type', '=', 'App\Anamnese')->get();
                        break;
                    case 4:
                        $query->where('auditable_type', '=', 'App\Doenca')->get();
                        break;
                    case 5:
                        $query->where('auditable_type', '=', 'App\Turma')->get();
                        break;
                    case 6:
                        $query->where('auditable_type', '=', 'App\Nucleo')->get();
                        break;
                }
            }
        });
        Session::put('quant', 'Foram encontrados '.count($auditslist->get()).' Auditorias no banco de dados.');
        $auditslist = $auditslist->paginate(10);
        $eventos = ['Criação','Edição','Exclusão'];
        $tabelas = ['Usuários','Professores','Clientes','Anamneses','Doenças','Turmas','Núcleos'];
        
        return view('audits_file.audits', compact('auditslist', 'eventos', 'tabelas', 'dataForm'));
    }

    public function pessoas_procurar_softdelete(PessoaProcurarFormRequest $request){
        $dataForm = $request->except('_token');
        $pessoaslist = Pessoa::onlyTrashed()->where(function($query) use($dataForm){;
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
            if(!empty($dataForm['bairro_id'])){
                $filtro = $dataForm['bairro_id'];
                $query->where('bairro_id', '=', $filtro);
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
                $query->where('sexo', 'like', $filtro."%");
            }
            if(!empty($dataForm['estado_civil'])){
                $filtro = $dataForm['estado_civil'];
                $query->where('estado_civil', 'like', $filtro."%");
            }
        })->orderBy('nome');
        $bairroslist = Bairro::all();
        Session::put('quant', 'Foram encontrados '.count($pessoaslist->get()).' pessoas no banco de dados.');
        $pessoaslist = $pessoaslist->paginate(10);
        $ano = date('Y');

        return view ('pessoas_file.pessoas_softdeletes', compact('pessoaslist', 'ano', 'dataForm'));
    }
}
