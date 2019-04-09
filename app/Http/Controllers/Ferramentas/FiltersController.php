<?php

namespace App\Http\Controllers\Ferramentas;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\Rule;

//REQUEST PARA CONTROLE
use App\Http\Requests\Professor\ProfessorProcurarFormRequest;
use App\Http\Requests\Anamnese\AnamneseProcurarFormRequest;
use App\Http\Requests\Professor\AlunoProcurarFormRequest;
use App\Http\Requests\Pessoa\PessoaProcurarFormRequest;
use App\Http\Requests\Nucleo\NucleoProcurarFormRequest;
use App\Http\Requests\Turma\TurmaProcurarFormRequest;
use App\http\Requests\User\UserProcurarFormRequest;

//MODELOS PARA CONTROLE:
use App\Professor;
use App\Anamnese;
use App\Doenca;
use App\Nucleo;
use App\Pessoa;
use App\Quant;
use App\Turma;
use App\Audit;
use App\User;

//CONTROLE DE FILTROS DE TODAS AS TABELAS:
//Comentarios em cima, código comentado em baixo.
class filtersController extends Controller{
    //FUNÇÕES DE REDIRECIONAMENTO:

    //Função usuario_procurar: Filtra conteudo de todos os registros de usuarios e retorna para a página de registro de usuarios.
    public function usuarios_procurar(UserProcurarFormRequest $request){
        $dataForm = $request->except('_tocken');

        //Encontra todos os registros de usuarios no banco de dados com base nos parametros que foram passados no filtro.
        $userslist = User::where(function($query) use ($dataForm){
            //Verifica se o usuário logado é um usuário mestre.
            if(auth()->user()->can('autorizacao', 1)){
                //Se sim, será filtrado os usuário de permissões do tipo 1.
               $query->where('permissao', '>', 1);
            }
            else{
                //Se não, será filtrado os usuários do tipo 1 e 2.
                $query->where('permissao', '>', 2);
            }

            //Verifica se o parametro "usuario" foi passado.
            if(!empty($dataForm['usuario'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['usuario'];

                //Constroi a query baseado neste parametro.
                $query->where('name', 'like', $filtro."%");
            }

            //Verifica se o parametro "nome" foi passado.
            if(!empty($dataForm['nome'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['nome'];

                //Constroi a query baseado neste parametro.
                $query->where('nick', 'like', $filtro."%");
            }

            //Verifica se o parametro "email" foi passado.
            if(!empty($dataForm['email'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['email'];

                //Constroi a query baseado neste parametro.
                $query->where('email', '=', $filtro);
            }

            //Verifica se o parametro "telefone" foi passado.
            if(!empty($dataForm['telefone'])){
                //Se sim:

                //Adiciona o parametro nos filtros;
                $filtro = $dataForm['telefone'];

                //Constroi a query baseado neste parametro.
                $query->where('telefone', 'like', $filtro."%");
            }

            //Verifica se o parametro "tipo" foi passado.
            if(isset($dataForm['tipo'])){
                //Se sim:
                
                //Adiciona o parametro nos filtros;
                $filtro = $dataForm['tipo'];

                 //Constroi a query baseado neste parametro.
                 $query->where('admin_professor', '=', $filtro);
            }

            //Verifica se o parametro "inativo" foi passado.
            if(!empty($dataForm['inativo'])){
                //Se sim:

                //Constroi a query baseado neste parametro.
                if($dataForm['inativo'] == '1'){
                    $query->where('deleted_at', '!=', null);
                }
                else{
                    $query->where('deleted_at', null);
                }
            }
        })->withTrashed()->orderBy('nick')->paginate(10);
        
        //Encontra o número definido como limite de quantidade de turmas que uma pessoa pode ter no sistema.
        $quantidade = Quant::find(1);

        return view ('auth.users', compact('userslist','quantidade','dataForm'));
    }

    //Função pessoas_procurar: Filtra conteudo de todos os registros de pessoas e retorna para a página de registro de pessoas.
    public function pessoas_procurar(PessoaProcurarFormRequest $request){
        $dataForm = $request->except('_token');
        
        //Encontra todos os registros de pessoas no banco de dados com base nos parametros que foram passados no filtro.
        $pessoaslist = Pessoa::where(function($query) use($dataForm){
            //Verifica se o parametro "nome" foi passado.
            if(!empty($dataForm['nome'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['nome'];

                //Constroi a query baseado neste parametro.
                $query->where('nome', 'like', $filtro."%");
            }

            //Verifica se o parametro "de" foi passado.
            if(!empty($dataForm['de'])){
                //Se sim:

                //Adiciona o parametro nos filtros;
                $filtro = explode(' ',$dataForm['de']);

                //Converte o filtro de dd/mm/YYYY para YYYY:mm:dd.
                list($dia, $mes, $ano) = explode('/', $filtro[0]);
                $nascimento = $ano.'-'.$mes.'-'.$dia;

                //Constroi a query baseado neste parametro.
                $query->where('nascimento',  '>=', $nascimento);
            }

            //Verifica se o parametro "ate" foi passado.
            if(!empty($dataForm['ate'])){
                //Se sim:

                //Adiciona o parametro nos filtros;
                $filtro = explode(' ',$dataForm['ate']);

                //Converte o filtro de dd/mm/YYYY para YYYY:mm:dd 00:00:00.
                list($dia, $mes, $ano) = explode('/', $filtro[0]);
                $nascimento = $ano.'-'.$mes.'-'.$dia;

                //Constroi a query baseado neste parametro.
                $query->where('nascimento',  '<=', $nascimento);
            }

            //Verifica se o parametro "rg" foi passado.
            if(!empty($dataForm['rg'])){
                //Se sim:

                //Adiciona o parametro nos filtros;
                $filtro = $dataForm['rg'];

                //Constroi a query baseado neste parametro.
                $query->where('rg', 'like', $filtro."%")->orWhere('rg_responsavel', 'like', $filtro.'%');
            }

            //Verifica se o parametro "cpf" foi passado.
            if(!empty($dataForm['cpf'])){
                //Se sim:

                //Adiciona o parametro nos filtros;
                $filtro = $dataForm['cpf'];

                //Constroi a query baseado neste parametro.
                $query->where('cpf', 'like', $filtro."%")->orWhere('cpf_responsavel', 'like', $filtro.'%');
            }

            //Verifica se o parametro "telefone" foi passado.
            if(!empty($dataForm['telefone'])){
                //Se sim:

                //Adiciona o parametro nos filtros;
                $filtro = $dataForm['telefone'];

                //Constroi a query baseado neste parametro.
                $query->where('telefone', 'like', $filtro."%");
            }

            //Verifica se o parametro "rua" foi passado.
            if(!empty($dataForm['rua'])){
                //Se sim:

                //Adiciona o parametro nos filtros;
                $filtro = $dataForm['rua'];

                //Constroi a query baseado neste parametro.
                $query->where('rua', 'like', $filtro."%");
            }

            //Verifica se o parametro "bairro" foi passado.
            if(!empty($dataForm['bairro'])){
                //Se sim:

                //Adiciona o parametro nos filtros;
                $filtro = $dataForm['bairro'];

                //Constroi a query baseado neste parametro.
                $query->where('bairro', '=', $filtro);
            }

            //Verifica se o parametro "morto" foi passado.
            if(!empty($dataForm['turmas'])){
                //Define a variavel $ids para filtrar os ids que serão passados.
                $filtro = '';

                foreach($dataForm['turmas'] as $turma){$filtro = $filtro.$turma.',';}
                $filtro = trim($filtro, ',');

                //$atribui a variavel $anamneseslistA todos os ids que encontra todas as anamneses que possuem a doença do parametro.
                $pessoasA = DB::select(DB::raw('SELECT * FROM turmas_pessoas WHERE
                                                        turma_id IN ('.$filtro.')'));
                
                $ids= [];

                //Atribui a variavel $ids todos os ids encontrados.
                foreach($pessoasA as $pessoa){array_push($ids, $pessoa->pessoa_id);}
                
                //Constroi a query baseado neste parametro.
                $query->wherein('id', $ids);
            }

            //Verifica se o parametro "morto" foi passado.
            if(!empty($dataForm['morto'])){
                //Se sim:
                
                //Adiciona o parametro nos filtros;
                $filtro = $dataForm['morto'];

                //Constroi a query baseado neste parametro.
                $query->where('morte', '=', $filtro);
            }

            //Verifica se o parametro "sexo" foi passado.
            if(!empty($dataForm['sexo'])){
                //Se sim:

                //Adiciona o parametro nos filtros;
                $filtro = $dataForm['sexo'];

                //Constroi a query baseado neste parametro.
                $query->where('sexo', '=', $filtro);
            }

            //Verifica se o parametro "estado_civil" foi passado.
            if(!empty($dataForm['estado_civil'])){
                //Se sim:

                //Adiciona o parametro nos filtros;
                $filtro = $dataForm['estado_civil'];

                //Constroi a query baseado neste parametro.
                $query->where('estado_civil', '=', $filtro);
            }

            //Verifica se o parametro "estado" foi passado.
            if(!empty($dataForm['estado'])){
                //Se sim:

                //Adiciona o parametro nos filtros;
                $filtro = $dataForm['estado'];

                //Constroi a query baseado neste parametro.
                $query->where('estado', '=', $filtro);
            }

            //Verifica se o parametro "atualizado" foi passado.
            if(!empty($dataForm['atualizado'])){
                $ano = date('Y');

                //Define a variavel $ids para filtrar os ids que serão passados.
                $ids = [];

                //Verifica se o parametro "atualizado" é S ou não.
                if($dataForm['atualizado'] == 'S'){
                    //Se sim, $atribui a variavel $pessoaslistA todos os ids que encontra todas as pessoas atualizadas.
                    $pessoaslistA = DB::select(DB::raw('SELECT id FROM pessoas WHERE
                                                        id IN(SELECT pessoas_id FROM anamneses WHERE
                                                            ano = '.$ano.')'));
                }
                else{
                    //Se não, $atribui a variavel $pessoaslistA todos os ids que encontra todas as pessoas não são atualizadas.
                    $pessoaslistA = DB::select(DB::raw('SELECT id FROM pessoas WHERE
                                                        id NOT IN(SELECT pessoas_id FROM anamneses WHERE
                                                            ano = '.$ano.')'));
                }

                //Atribui a variavel $ids todos os ids encontrados.
                foreach($pessoaslistA as $id){array_push($ids, $id->id);}

                //Constroi a query baseado neste parametro.
                $query->wherein('id', $ids);
            }
        })->orderBy('nome');

        //Define sessão de informação com base na quantidade de registros achados.
        Session::put('quant', count($pessoaslist->get()).' pessoas cadastradas.');

        $turmaslist = Turma::orderBy('nome')->get();

        //Cria paginate para os registros encontrados.
        $pessoaslist = $pessoaslist->paginate(10);

        return view ('pessoas_file.pessoas', compact('pessoaslist','bairroslist', 'ano', 'dataForm', 'turmaslist'));
    }

    //Função professor_procurar: Filtra conteudo de todos os registros de professor e retorna para a página de registro de professor.
    public function professor_procurar(ProfessorProcurarFormRequest $request){
        $dataForm = $request->except('_token');

        //Encontra todos os registros de professores no banco de dados com base nos parametros que foram passados no filtro
        $professoreslist = Professor::where(function($query) use($dataForm){
            //Verifica se o parametro "nome" foi passado.
            if(!empty($dataForm['nome'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['nome'];

                //Constroi a query baseado neste parametro.
                $query->where('nome', 'like', $filtro."%");
            }

            //Verifica se o parametro "de" foi passado.
            if(!empty($dataForm['de'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = explode(' ',$dataForm['de']);

                //Converte o filtro de dd/mm/YYYY para YYYY:mm:dd 00:00:00.
                list($dia, $mes, $ano) = explode('/', $filtro[0]);
                $nascimento = $ano.'-'.$mes.'-'.$dia;

                //Constroi a query baseado neste parametro.
                $query->where('nascimento',  '>=', $nascimento);
            }

            //Verifica se o parametro "ate" foi passado.
            if(!empty($dataForm['ate'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = explode(' ',$dataForm['ate']);

                //Converte o filtro de dd/mm/YYYY para YYYY:mm:dd 00:00:00.
                list($dia, $mes, $ano) = explode('/', $filtro[0]);
                $nascimento = $ano.'-'.$mes.'-'.$dia;

                //Constroi a query baseado neste parametro.
                $query->where('nascimento',  '<=', $nascimento);
            }

            //Verifica se o parametro "email" foi passado.
            if(!empty($dataForm['email'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['email'];

                //Encontra o usuário que possui o email passado por parametros para filtros.
                $useremails = User::all()->where('email', 'like', $filtro)->where('admin_professor', '=', 0)->last();

                //Constroi a query baseado neste parametro.
                $query->where('user_id', '=', $useremails->id);
            }

            //Verifica se o parametro "matricula" foi passado.
            if(!empty($dataForm['matricula'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['matricula'];

                //Constroi a query baseado neste parametro.
                $query->where('matricula', 'like', $filtro."%");
            }

            //Verifica se o parametro "telefone" foi passado.
            if(!empty($dataForm['telefone'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['telefone'];

                //Constroi a query baseado neste parametro.
                $query->where('telefone', 'like', $filtro."%");
            }

            //Verifica se o parametro "bairro" foi passado.
            if(!empty($dataForm['bairro'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['bairro'];

                //Constroi a query baseado neste parametro.
                $query->where('bairro', 'like', $filtro."%");
            }

            //Verifica se o parametro "rua" foi passado.
            if(!empty($dataForm['rua'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['rua'];

                //Constroi a query baseado neste parametro.
                $query->where('rua', 'like', $filtro."%");
            }
        })->orderBy('nome');
        
        //Define sessão de informação com base na quantidade de registros achados.
        Session::put('quant', count($professoreslist->get()).' professores cadastrados.');

        //Cria paginate para os registros encontrados.
        $professoreslist = $professoreslist->paginate(10);

        return view ('professores_file.professores', compact('professoreslist', 'turmaslist', 'dataForm'));
    }

    //Função pessoas_procurar_aluno: Filtra conteudo de todos os registros de pessoas e retorna para a página de professores e alunos.
    public function professor_procurar_aluno(AlunoProcurarFormRequest $request){
        $dataForm = $request->except('_token');

        //Encontra todos os registros de pessoas no banco de dados com base nos parametros que foram passados no filtro
        $pessoaslist = Pessoa::where(function($query) use($dataForm){
            //Verifica se o parametro "nome" foi passado.
            if(!empty($dataForm['nome'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['nome'];

                //Constroi a query baseado neste parametro.
                $query->where('nome', 'like', $filtro."%");
            }

            //Verifica se o parametro "de" foi passado.
            if(!empty($dataForm['de'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = explode(' ',$dataForm['de']);

                //Converte o filtro de dd/mm/YYYY para YYYY:mm:dd 00:00:00.
                list($dia, $mes, $ano) = explode('/', $filtro[0]);
                $nascimento = $ano.'-'.$mes.'-'.$dia;

                //Constroi a query baseado neste parametro.
                $query->where('nascimento',  '>=', $nascimento);
            }

            //Verifica se o parametro "ate" foi passado.
            if(!empty($dataForm['ate'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = explode(' ',$dataForm['ate']);

                //Converte o filtro de dd/mm/YYYY para YYYY:mm:dd 00:00:00.
                list($dia, $mes, $ano) = explode('/', $filtro[0]);
                $nascimento = $ano.'-'.$mes.'-'.$dia;

                //Constroi a query baseado neste parametro.
                $query->where('nascimento',  '<=', $nascimento);
            }

            //Verifica se o parametro "telefone" foi passado.
            if(!empty($dataForm['telefone'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['telefone'];

                //Constroi a query baseado neste parametro.
                $query->where('telefone', 'like', $filtro."%");
            }

            //Verifica se o parametro "sexo" foi passado.
            if(!empty($dataForm['sexo'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['sexo'];

                //Constroi a query baseado neste parametro.
                $query->where('sexo', '=', $filtro);
            }

            //Define a variavel $ids para filtrar os ids que serão passados.
            $ids = [];

            //$atribui a variavel $pessoaslistA todos os ids que encontra todas as pessoas que possuem vinculo com a turma passada.
            $pessoaslistA = DB::select(DB::raw('SELECT id FROM pessoas WHERE
                                                id in(SELECT pessoa_id FROM turmas_pessoas WHERE
                                                    turma_id = :turma)'), ['turma'=>$dataForm['idturma']]);
                                                    
            //Atribui a variavel $ids todos os ids encontrados.
            foreach($pessoaslistA as $id){array_push($ids, $id->id);}

            //Constroi a query baseado neste parametro.
            $query->wherein('id', $ids)->get();
        })->orderBy('nome');

        //Encontra a turma no banco de dados que foi passada por parametro.
        $turma = Turma::find($dataForm['idturma']);

        //Encontra o professor no banco de dados que foi passada por parametro.
        $professor = Professor::find($dataForm['professorid']);

        //Define sessão de informação com base na quantidade de registros achados.
        Session::put('quant', count($pessoaslist).' pessoas cadastradas.');


        return view ('professores_file.professores_meus_alunos', compact('turma','pessoaslist','professor'));
    }

    //Função turmas_procurar: Filtra conteudo de todos os registros de turmas e retorna para diferentes páginas com base na opção passada.
    //Se o parametro "id" for maior que 0, retorna para página de professores e turmas.
    //Se o parametro "id" for menor que 0, retorna para página de pessoas e turmas.
    //Se o parametro "id" for igual que 0, retorna para página de registros de turmas.
    public function turmas_procurar(TurmaProcurarFormRequest $request){
        $dataForm = $request->except('_token');

        //Encontra todos os registros de turmas no banco de dados com base nos parametros que foram passados no filtro
        $turmaslist = Turma::where(function($query) use($dataForm){
            //Verifica se o parametro "nome" foi passado.
            if(!empty($dataForm['nome'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['nome'];

                //Constroi a query baseado neste parametro.
                $query->where('nome', 'like', "%".$filtro."%");
            }

            //Verifica se o parametro "inativo" foi passado.
            if(!empty($dataForm['inativo'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['inativo'];

                //Constroi a query baseado neste parametro.
                $query->where('inativo', '=', $filtro."%");
            }
            
            //Verifica se o parametro "limite" foi passado.
            if(!empty($dataForm['limite'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['nome'];

                //Constroi a query baseado neste parametro.
                $query->where('nome', 'like', $filtro."%");
            }

            //Verifica se o parametro "horario_inicial" foi passado.
            if(!empty($dataForm['horario_inicial'])){
                //Se sim:

                //Adiciona o parametro nos horario.
                $filtro = explode(' ', $dataForm['horario_inicial']);

                //Constroi a query baseado neste parametro.
                $query->where('horario_inicial', '=', $filtro);
            }

            //Verifica se o parametro "horario_final" foi passado.
            if(!empty($dataForm['horario_final'])){
                //Se sim:

                //Adiciona o parametro nos horario.
                $filtro = explode(' ', $dataForm['horario_final']);

                //Constroi a query baseado neste parametro.
                $query->where('horario_final', '=', $filtro);
            }

            //Verifica se o parametro "data_semanal" foi passado.
            if(!empty($dataForm['data_semanal'])){
                //Define a variavel $filtro vazia, cada data_semanal passada por parametro será adicionado na variavel $filtro.
                $filtro = '';
                foreach($dataForm['data_semanal'] as $data){$filtro = $filtro.$data.',';}

                //Constroi a query baseado neste parametro.
                $query->where('data_semanal', 'like', '%'.$filtro.'%');
            }

            //Verifica se o parametro "nucleo_id" foi passado.
            if(!empty($dataForm['nucleo_id'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['nucleo_id'];

                //Constroi a query baseado neste parametro.
                $query->where('nucleo_id', '=', $filtro);
            }

            //Verifica se o parametro "pagina" foi passado.
            if(!empty($dataForm['pagina'])){
                //Se sim:

                //Define variavel $string que será utilizado para construir a query base para encontrar os ids necessários.
                $string = '';

                //Verifica se o parametro "id" é maior que 0.
                if($dataForm['id'] > 0){
                    //Se sim, atribui a variavel $string todos os ids que encontra todas as turmas que possuem vinculo com o professor.
                    $string = 'SELECT id from turmas WHERE id in(SELECT turma_id FROM turmas_professores WHERE professor_id = :sujeito';
                }
                else{
                    //Se não, atribui a variavel $string todos os ids que encontra todas as turmas que possuem vinculo com a pessoa.
                    $string = 'SELECT id from turmas WHERE id in(SELECT turma_id FROM turmas_pessoas WHERE pessoa_id = :sujeito';
                    $dataForm['id'] = -$dataForm['id'];
                }

                //Define a variavel $ids para filtrar os ids que serão passados.
                $ids = [];

                //Verifica se o parametro "pagina" é igual a 3.
                if($dataForm['pagina'] == 3){
                    //Se sim:

                    //Completa a variavel $string e executa no banco de dados.
                    $string = $string.')';
                    $turmaslistA = DB::select(DB::raw($string), ['sujeito'=>$dataForm['id']]);

                    //Atribui a variavel $ids todos os ids encontrados.
                    foreach($turmaslistA as $id){array_push($ids, $id->id);}

                    //Constroi a query baseado neste parametro.
                    $query->whereNotIn('id', $ids);
                }
                else{
                    //Se não:

                    //Completa a variavel $string e executa no banco de dados.
                    $string = $string.' and inativo = '.$dataForm['pagina'].')';
                    $turmaslistA = DB::select(DB::raw($string), ['sujeito'=>$dataForm['id']]);

                    //Atribui a variavel $ids todos os ids encontrados.
                    foreach($turmaslistA as $id){array_push($ids, $id->id);}

                    //Constroi a query baseado neste parametro.
                    $query->wherein('id', $ids);
                }
            }
        })->orderBy('nome');

        //Define sessão de informação com base na quantidade de registros achados.
        Session::put('quant', count($turmaslist->get()).' turmas cadastradas.');

        //Encontra todos os registros de núcleos no banco de dados
        $nucleoslist = Nucleo::all();

        //Criando array de dias da semana.
        $dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];
        if($dataForm['id'] > 0){
            //Cria paginate para os registros encontrados.
            $turmaslist = $turmaslist->paginate(10);

            //Encontra o professor no banco de dados que foi passada por parametro.
            $professor = Professor::find($dataForm['id']);

            return view ('professores_file.professores_turmas', compact('professor','turmaslist','nucleoslist','dias_semana','dataForm'));
        }
        elseif ($dataForm['id'] < 0) {
            //Cria paginate para os registros encontrados.
            $turmaslist = $turmaslist->paginate(10);

            //Encontra a pessoa no banco de dados que foi passada por parametro.
            $pessoa = Pessoa::find(-$dataForm['id']);

            //Encontra o número definido como limite de quantidade de turmas que uma pessoa pode ter no sistema.
            $quantidade = Quant::find(1);

            return view ('pessoas_file.pessoas_turmas', compact('pessoa', 'turmaslist', 'nucleoslist', 'dias_semana', 'dataForm','quantidade'));
        }
        else{
            //Cria paginate para os registros encontrados.
            $turmaslist = $turmaslist->paginate(10);

            return view ('turmas_file.turmas', compact('turmaslist', 'nucleoslist', 'dias_semana', 'dataForm'));
        }
    }

    //Função anamnese_procurar: Filtra conteudo de todos os registros de anamneses e retorna para a página de registro de anamneses.
    public function anamnese_procurar(AnamneseProcurarFormRequest $request){
        $ano = date('Y');
        $dataForm = $request->except('_token');

        //Encontra todos os registros de anamneses no banco de dados com base nos parametros que foram passados no filtro
        $anamneseslist = Anamnese::where(function($query) use($dataForm){
            //Verifica se o parametro "historico" foi passado.
            if(!empty($dataForm['historico'])){
                //Se sim:

                //Verifica se o parametro "historico" é igual a 1.
                if($dataForm['historico'] == 1){
                    //Se sim:
    
                    //Constroi a query baseado no parametro de $ano.
                    $query->where('ano', '=', $ano)->get();
                }
                elseif($dataForm['historico'] == 2){
                    //Se não:
    
                    //Constroi a query baseado no parametro de $ano.
                    $query->where('ano', '<', $ano)->get();
                }
            }

            //Verifica se o parametro "de_peso" foi passado.
            if(!empty($dataForm['de_peso'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['de_peso'];

                //Constroi a query baseado neste parametro.
                $query->where('peso', '>=', $filtro);
            }

            //Verifica se o parametro "ate_peso" foi passado.
            if(!empty($dataForm['ate_peso'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['ate_peso'];

                //Constroi a query baseado neste parametro.
                $query->where('peso', '<=', $filtro);
            }

            //Verifica se o parametro "de_altura" foi passado.
            if(!empty($dataForm['de_altura'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['de_altura'];

                //Constroi a query baseado neste parametro.
                $query->where('altura', '>=', $filtro);
            }

            //Verifica se o parametro "ate_altura" foi passado.
            if(!empty($dataForm['ate_altura'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['ate_altura'];

                //Constroi a query baseado neste parametro.
                $query->where('altura', '<=', $filtro);
            }

            //Verifica se o parametro "toma_medicacao" foi passado.
            if(!empty($dataForm['toma_medicacao'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['toma_medicacao'];

                //Constroi a query baseado neste parametro.
                $query->where('toma_medicacao', '=', $filtro);
            }

            //Verifica se o parametro "cirurgia" foi passado.
            if(!empty($dataForm['cirurgia'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['cirurgia'];

                //Constroi a query baseado neste parametro.
                $query->where('cirurgia', '=', $filtro);
            }

            //Verifica se o parametro "fumante" foi passado.
            if(!empty($dataForm['fumante'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['fumante'];

                //Constroi a query baseado neste parametro.
                $query->where('fumante', '=', $filtro);
            }

            //Verifica se o parametro "doencas" foi passado.
            if(isset($dataForm['doenca'])){
                //Define a variavel $ids para filtrar os ids que serão passados.
                $ids = [];

                //$atribui a variavel $anamneseslistA todos os ids que encontra todas as anamneses que possuem a doença do parametro.
                $anamneseslistA = DB::select(DB::raw('SELECT * FROM anamneses_doencas WHERE
                                                        doenca_id = :doenca'), ['doenca' => $dataForm['doenca'][0]]);

                //Atribui a variavel $ids todos os ids encontrados.
                foreach($anamneseslistA as $id){array_push($ids, $id->id);}

                //Constroi a query baseado neste parametro.
                $query->wherein('id', $ids);
            }
        })->orderBy('ano', 'desc');

        //Define sessão de informação com base na quantidade de registros achados.
        Session::put('quant', count($anamneseslist->get()).' anamneses de '.$ano.' cadastradas.');

        //Cria paginate para os registros encontrados.
        $anamneseslist = $anamneseslist->paginate(10);

        //Encontra todos os registros de doenças no banco de dados.
        $doencaslist = Doenca::all();

        return view ('anamneses_file.anamneses', compact('anamneseslist', 'ano', 'doencaslist','dataForm'));
    }

    //Função núcleos_procurar: Filtra conteudo de todos os registros de núcleos e retorna para a página de registro de núcleos.
    public function nucleos_procurar(NucleoProcurarFormRequest $request){
        $dataForm = $request->except('_token');

        //Encontra todos os registros de núcleos no banco de dados com base nos parametros que foram passados no filtro.
        $nucleoslist = Nucleo::where(function($query) use($dataForm){
            //Verifica se o parametro "nome" foi passado.
            if(!empty($dataForm['nome'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['nome'];

                //Constroi a query baseado neste parametro.
                $query->where('nome', 'like', $filtro."%");
            }

            //Verifica se o parametro "inativo" foi passado.
            if(!empty($dataForm['inativo'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['inativo'];

                //Constroi a query baseado neste parametro.
                $query->where('inativo', '=', $filtro);
            }

            //Verifica se o parametro "bairro" foi passado.
            if(!empty($dataForm['bairro'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['bairro'];

                //Constroi a query baseado neste parametro.
                $query->where('bairro', 'like', $filtro."%");
            }

            //Verifica se o parametro "rua" foi passado.
            if(!empty($dataForm['rua'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['rua'];

                //Constroi a query baseado neste parametro.
                $query->where('rua', 'like', $filtro."%");
            }

            //Verifica se o parametro "numero_endereco" foi passado.
            if(!empty($dataForm['numero_endereco'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['numero_endereco'];

                //Constroi a query baseado neste parametro.
                $query->where('numero_endereco', 'like', $filtro."%");
            }

            //Verifica se o parametro "cep" foi passado.
            if(!empty($dataForm['cep'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['cep'];

                //Constroi a query baseado neste parametro.
                $query->where('cep', 'like', $filtro."%");
            }
        })->orderBy('nome');

        //Define sessão de informação com base na quantidade de registros achados.
        Session::put('quant', count($nucleoslist->get()).' núcleos cadastrados.');

        //Cria paginate para os registros encontrados.
        $nucleoslist = $nucleoslist->paginate(10);

        //Criando array de bairros de São Leopoldo.
        $bairroslist = ['ARROIO DA MANTEIGA','BOA VISTA','CAMPESTRE','CAMPINA','CENTRO','CRISTO REI','DUQUE DE CAXIAS',
                        'FAZENDA SAO BORJA','FEITORIA','FIAO','JARDIM AMERICA','MORRO DO ESPELHO','PADRE REUS','PINHEIRO',
                        'RIO BRANCO','RIO DOS SINOS','SANTA TEREZA','SANTO ANDRE','SANTOS DUMONT','SAO JOAO BATISTA',
                        'SAO JOSE','SAO MIGUEL','SCHARLAU','VICENTINA'];

        return view ('nucleos_file.nucleos', compact('nucleoslist','dataForm','bairroslist'));
    }

    //Função doenças_procurar: Filtra conteudo de todos os registros de doenças e retorna para a página de registro de doenças.
    public function doencas_procurar(Request $request){
        $dataForm = $request->except('_token');
	    dd('asfsf');
        //Encontra todos os registros de doenças no banco de dados e ordena por nome.
        $doencaslist = Doenca::orderBy('nome')->paginate(10);

        //Verifica se o parametro "nome" foi passado.
        if($dataForm['nome'] != null){
            //Se sim:

            //Substitui o registro de doenças filtrando apenas o nome com o parametro passado pelo filtro.
            $doencaslist = Doenca::orderBy('nome')->where('nome', 'like', $dataForm['nome'].'%')->paginate(10);
        }

        //Define variavel $count para informação de quantidade de registros.
        $count = Doenca::all();
        Session::put('quant', count($count).' doenças cadastradas.');

        return view ('doencas_file.doencas', compact('doencaslist','dataForm'));
    }

    //Função audits_procurar: Filtra conteudo de todos os registros de auditorias e retorna para a página de registro de auditorias.
    public function audits_procurar(Request $request){
        $dataForm = $request->except('_token');

        //Encontra todos os registros de auditorias no banco de dados com base nos parametros que foram passados no filtro.
        $auditslist = Audit::where(function($query) use($dataForm){
            //Verifica se o parametro "eventos" foi passado.
            if(isset($dataForm['eventos'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['eventos'];

                //Switch de escolhe:
                //Se o valor foi 0: constroi query encontrando retorna todas as auditorias que são de criação.
                //Se o valor foi 1: constroi query encontrando retorna todas as auditorias que são de edição.
                switch ($filtro) {
                    case 1:
                        $query->where('event', '=', 'created')->get();
                        break;
                    case 2:
                        $query->where('event', '=', 'updated')->get();
                        break;
                }
            }

            //Verifica se o parametro "tabelas" foi passado.
            if(isset($dataForm['tabelas'])){
                //Se sim:

                //Adiciona o parametro nos filtros.
                $filtro = $dataForm['tabelas'];

                //Switch de escolhe:
                //Se o valor foi 0: constroi query encontrando todas as auditorias que são da tabela de quant_pessoas_turmas.
                //Se o valor foi 1: constroi query encontrando todas as auditorias que são da tabela de users.
                //Se o valor foi 2: constroi query encontrando todas as auditorias que são da tabela de professores.
                //Se o valor foi 3: constroi query encontrando todas as auditorias que são da tabela de pessoas.
                //Se o valor foi 4: constroi query encontrando todas as auditorias que são da tabela de anamneses.
                //Se o valor foi 5: constroi query encontrando todas as auditorias que são da tabela de doencas.
                //Se o valor foi 6: constroi query encontrando todas as auditorias que são da tabela de turmas.
                //Se o valor foi 7: constroi query encontrando todas as auditorias que são da tabela de nucleos.
                switch ($filtro[0]) {
                    case 0:
                        $query->where('auditable_type', '=', 'App\quant')->get();
                        break;
                    case 1:
                        $query->where('auditable_type', '=', 'App\user')->get();
                        break;
                    case 2:
                        $query->where('auditable_type', '=', 'App\Professor')->get();
                        break;
                    case 3:
                        $query->where('auditable_type', '=', 'App\Pessoa')->get();
                        break;
                    case 4:
                        $query->where('auditable_type', '=', 'App\Anamnese')->get();
                        break;
                    case 5:
                        $query->where('auditable_type', '=', 'App\Doenca')->get();
                        break;
                    case 6:
                        $query->where('auditable_type', '=', 'App\Turma')->get();
                        break;
                    case 7:
                        $query->where('auditable_type', '=', 'App\Nucleo')->get();
                        break;
                }
            }
        });

        //Define sessão de informação com base na quantidade de registros achados.
        Session::put('quant', count($auditslist->get()).' auditorias cadastradas.');

        //Cria paginate para os registros encontrados.
        $auditslist = $auditslist->paginate(10);

        //Criando array de de tabelas para filtro.
        $tabelas = ['Quantidade limite','Usuários','Professores','Clientes','Anamneses','Doenças','Turmas','Núcleos'];
        
        return view('audits_file.audits', compact('auditslist', 'tabelas', 'dataForm'));
    }
}
