<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

//REQUESTS PARA CONTROLE:
use App\Http\Requests\Turma\TurmaCreateEditFormRequest;
use App\Http\Requests\Turma\TurmaProcurarFormRequest;
use App\Http\Requests\regrasTurma;

//MODELOS PARA CONTROLE:
use App\Turma;
use App\Nucleo;
use App\Pessoa;
use App\Professor;
use App\HistoricoT;
use App\HistoricoPT;

//CONTROLE DE TURMAS:
//Comentarios em cima, código comentado em baixo.
class TurmasController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //FUNÇÕES DE FERRAMENTAS:
    //Ferramenta convertHorario: Converte o horário de MM:HH [PM|AM] para HH:MM:SS.
    public function convertHorario($hora, $op){
        if($op == 1){
            $horario = explode(' ', $hora);

            //Se foi definido 'PM', adicionar 12 horas para a criação.
            if($horario[1] == 'PM'){
                $separador = explode(':', $horario[0]);
                $separador[0] = 12 + (int)$separador[0];
                $horario[0] = $separador[0].':'.$separador[1];
            }

            return $horario[0].':00';
        }
        else{
            $horario = explode(':', $hora);

            if($horario[0] > 12){
                $horario[0] = (int)$horario[0] - 12;
                if($horario[0] < 10){$horario[0] = '0'.$horario[0];}
                $horario[2] = 'PM';
                
                return $horario[0].':'.$horario[1].' '.$horario[2];
            }
            $horario[2] = 'AM';

            return $horario[0].':'.$horario[1].' '.$horario[2];
        }
    }

    //FUNÇÕES DE REDIRECIONAMENTO:
    //Função index, retorna a página de registros de turmas.
    public function index(){
        //Encontra todos os registros de turmas.
        $turmaslist = Turma::orderBy('nome')->paginate(10);

        //Encontra todos os registros de núcleos.
        $nucleoslist = Nucleo::all();

        //Criando array de dias da semana.
        $dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];

        //Atribui count para definir sessão de informação.
        $count = Turma::all();
        Session::put('quant', count($count).' turmas cadastradas.');

        return view ('turmas_file.turmas', compact('turmaslist', 'nucleoslist', 'dias_semana'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Função create, retorna a página de criação de registros de turmas.
    public function create(){
        //Encontra todos os registros de nucleos.
        $nucleoslist = Nucleo::orderBy('nome')->get();

        //Criando array de dias da semana.
        $dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];

        return view ('turmas_file.turmas_create', compact('nucleoslist', 'dias_semana'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //Função store, faz as mudanças necessarias para adicionar no banco de dados e retorna a página de registro de turmas.
    public function store(TurmaCreateEditFormRequest $request){
        $dataForm = $request->all();

        //Define a variavel dias_da_semana para compactar todos os dias da semana escolhidas e depois define para a criação.
        $dias_da_semana = '';
        foreach($dataForm['data_semanal'] as $data){$dias_da_semana = $dias_da_semana.$data.',';}
        $dataForm['data_semanal'] = $dias_da_semana;

        //Converte o horário de MM:HH [PM|AM] para HH:MM:SS para a criação (HORARIO INICIAL):
        $horario = explode(' ', $dataForm['horario_inicial']);

        //Se foi definido 'PM', adicionar 12 horas para a criação.
        if($horario[1] == 'PM'){
            $separador = explode(':', $horario[0]);
            $separador[0] = 12 + (int)$separador[0];
            $horario[0] = $separador[0].':'.$separador[1];
        }
        $dataForm['horario_inicial'] = $horario[0].':00';

        //Converte o horário de MM:HH [PM|AM] para HH:MM:SS para a criação (HORARIO FINAL):
        $horario = explode(' ', $dataForm['horario_final']);

        //Se foi definido 'PM', adicionar 12 horas para a criação.
        if($horario[1] == 'PM'){
            $separador = explode(':', $horario[0]);
            $separador[0] = 12 + (int)$separador[0];
            $horario[0] = $separador[0].':'.$separador[1];
        }
        $dataForm['horario_final'] = $horario[0].':00';

        //Encontra todos os registros de turmas.
        $turma = Turma::create($dataForm);

        //Define sessõa de informação para apresentação na página.
        Session::put('mensagem_green', "A turma " . $turma->nome . " foi cadastrada com sucesso!");

        return redirect()->Route('turmas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $turma = Turma::find($id);
        $nucleoslist = Nucleo::all();
        $horario = explode(':', $turma['horario_inicial']);
        if($horario[0] > 12){
            $horario[0] = (int)$horario[0] - 12;
            if($horario[0] < 10){$horario[0] = '0'.$horario[0];}
            $horario[2] = 'PM';
            $turma['horario_inicial'] = $horario[0].':'.$horario[1].' '.$horario[2];
        }
        else{
            $horario[2] = 'AM';
            $turma['horario_inicial'] = $horario[0].':'.$horario[1].' '.$horario[2];
        }
        $horario = explode(':', $turma['horario_final']);
        if($horario[0] > 12){
            $horario[0] = (int)$horario[0] - 12;
            if($horario[0] < 10){$horario[0] = '0'.$horario[0];}
            $horario[2] = 'PM';
            $turma['horario_final'] = $horario[0].':'.$horario[1].' '.$horario[2];
        }
        else{
            $horario[2] = 'AM';
            $turma['horario_final'] = $horario[0].':'.$horario[1].' '.$horario[2];
        }
        $dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];
        $datas_escolhidas = explode(',', $turma['data_semanal']);
        unset($datas_escolhidas[count($datas_escolhidas) - 1]);

        return view ('turmas_file.turmas_edit', compact('turma', 'nucleoslist', 'dias_semana', 'datas_escolhidas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TurmaCreateEditFormRequest $request, $id){
        $dataForm = $request->all();
        $turma = Turma::find($id);
        $oldturma = (array)$turma;
        $dias_da_semana = '';
        foreach($dataForm['data_semanal'] as $data){
            $dias_da_semana = $dias_da_semana.$data.',';
        }
        $dataForm['data_semanal'] = $dias_da_semana;
        $horario = explode(' ', $dataForm['horario_inicial']);
        if($horario[1] == 'PM'){
            $separador = explode(':', $horario[0]);
            $separador[0] = 12 + (int)$separador[0];
            $horario[0] = $separador[0].':'.$separador[1];
        }
        $dataForm['horario_inicial'] = $horario[0].':00';
        $horario = explode(' ', $dataForm['horario_final']);
        if($horario[1] == 'PM'){
            $separador = explode(':', $horario[0]);
            $separador[0] = 12 + (int)$separador[0];
            $horario[0] = $separador[0].':'.$separador[1];
        }
        $dataForm['horario_final'] = $horario[0].':00';
        $dataForm += ['inativo' => $turma->inativo];
        $turma->update($dataForm);
        $newturma = (array)$turma;
        if($newturma != $oldturma){
            Session::put('mensagem_green', $turma->nome.' adicionada com sucesso!');
        }
        return redirect()->Route('turmas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id){
        //
    }

    public function turma_info($id){
        $turma = Turma::find($id);
        $horario = explode(':', $turma['horario_inicial']);
        if($horario[0] > 12){
            $horario[0] = (int)$horario[0] - 12;
            if($horario[0] < 10){$horario[0] = '0'.$horario[0];}
            $horario[2] = 'PM';
            $turma['horario_inicial'] = $horario[0].':'.$horario[1].' '.$horario[2];
        }
        else{
            $horario[2] = 'AM';
            $turma['horario_inicial'] = $horario[0].':'.$horario[1].' '.$horario[2];
        }
        $horario = explode(':', $turma['horario_final']);
        if($horario[0] > 12){
            $horario[0] = (int)$horario[0] - 12;
            if($horario[0] < 10){$horario[0] = '0'.$horario[0];} 
            $horario[2] = 'PM';
            $turma['horario_final'] = $horario[0].':'.$horario[1].' '.$horario[2];
        }
        else{
            $horario[2] = 'AM';
            $turma['horario_final'] = $horario[0].':'.$horario[1].' '.$horario[2];
        }
        $dias = explode(',', $turma['data_semanal']);
        unset($dias[count($dias) - 1]);
        $histturma = HistoricoT::orderBy('created_at', 'desc')->where('turma_id', '=', $turma->id)->paginate(6);
        $a = 0;
        $b = 0;
        foreach($turma->pessoas as $pessoa){
            if($pessoa->pivot->inativo == 1){$b++;}
            $a++;
        }
        $c = $a - $b;
        $dadosgerais = [$a,$b,$c];
        if(auth()->user()->admin_professor == 0){
            $professor = Professor::where('user_id', '=', auth()->user()->id)->first();
            return view ('turmas_file.turmas_info', compact('turma','dias','histturma','dadosgerais','professor'));
        }
        return view('turmas_file.turmas_info', compact('turma','dias','histturma','dadosgerais'));
    }

    public function turmas_ativar_inativar(Request $request){
        $dataForm = $request->all();
        $turma = Turma::find($dataForm['turma_id']);
        if($turma->inativo == 1){
            $turma->update(['inativo'=>2]);
            $dataForm += ['inativo' => 2];

            //Inativa todas as pessoas da turma.
            foreach($turma->pessoas as $pessoa){
                //Update no banco de dados para inativar todas as pessoas.
                DB::update(DB::raw('update turmas_pessoas set inativo = 2 where pessoa_id = :sujeito and turma_id = :turma'), ['sujeito'=>$pessoa->id, 'turma'=>$turma->id]);

                //Criar histórico no banco de dados.
                HistoricoPT::create([
                    'pessoa_id' => $pessoa->id,
                    'turma_id' => $turma->id,
                    'comentario' => 'Pessoa inativada devido a inativação da turma.',
                    'inativo' => 2,
                ]);
            }

            Session::put('mensagem_green', $turma->nome . " foi inativado com sucesso!");
        }
        else{
            $turma->update(['inativo'=>1]);
            $dataForm += ['inativo' => 1];
            Session::put('mensagem_green', $turma->nome . " foi ativado com sucesso!");
        }
        HistoricoT::create($dataForm);

        return redirect()->Route('turmas.index');
    }
}
