<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\regrasTurma;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\Turma\TurmaCreateEditFormRequest;
use App\Turma;
use App\Nucleo;
use App\Pessoa;
use App\Professor;

class turmasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Funções de Redirecionamento
    public function index()
    {
        $nucleoslist = Nucleo::all();
        $turmaslist = Turma::orderBy('nome')->paginate(10);
        $dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];
        $turmaall = Turma::all();
        Session::put('quant', 'Foram encontrados '.count($turmaall).' turmas no banco de dados.');

        return view ('turmas_file.turmas', compact('turmaslist', 'nucleoslist', 'dias_semana'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nucleoslist = Nucleo::orderBy('nome')->get();
        $dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];
        return view ('turmas_file.turmas_create', compact('nucleoslist', 'dias_semana'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TurmaCreateEditFormRequest $request)
    {
        $dataForm = $request->all();
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
        $turma = Turma::create($dataForm);
        Session::put('mensagem', "A turma " . $turma->nome . " foi cadastrada com sucesso!");
        return redirect()->Route('turmas.index');
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
    public function update(TurmaCreateEditFormRequest $request, $id)
    {
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
        $turma->update($dataForm);
        $newturma = (array)$turma;
        if($newturma != $oldturma){
            Session::put('mensagem', $turma->nome.' adicionada com sucesso!');
        }
        return redirect()->Route('turmas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $turma = Turma::find($request['id']);
        $nome = $turma->nome;
        $turma->delete();
        Session::put('mensagem', $nome.' editado com sucesso!');

        return redirect()->Route('turmas.index');
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

        return view('turmas_file.turmas_info', compact('turma', 'dias'));
    }

    public function turmas_procurar(Request $request){
        $dataForm = array_filter($request->all());
        
        $turmaslist = Turma::where(function($query) use($dataForm){
            if(array_key_exists('nome', $dataForm)){
                $filtro = $dataForm['nome'];
                $query->where('nome', 'like', "%".$filtro."%");
            }
            if(array_key_exists('inativo', $dataForm)){
                $filtro = $dataForm['inativo'];
                $query->where('inativo', '=', $filtro."%");
            }
            if(array_key_exists('limite', $dataForm)){
                $filtro = $dataForm['nome'];
                $query->where('nome', 'like', $filtro."%");
            }
            if(array_key_exists('horario_inicial', $dataForm)){
                $horario = explode(' ', $dataForm['horario_inicial']);
                if($horario[1] == 'PM'){
                    $separador = explode(':', $horario[0]);
                    $separador[0] = 12 + (int)$separador[0];
                    $horario[0] = $separador[0].':'.$separador[1];
                }
                $filtro = $horario[0].':00';
                $query->where('horario_inicial', '=', $filtro);
            }
            if(array_key_exists('horario_final', $dataForm)){
                $horario = explode(' ', $dataForm['horario_final']);
                if($horario[1] == 'PM'){
                    $separador = explode(':', $horario[0]);
                    $separador[0] = 12 + (int)$separador[0];
                    $horario[0] = $separador[0].':'.$separador[1];
                }
                $filtro = $horario[0].':00';
                $query->where('horario_final', '=', $filtro);
            }
            if(array_key_exists('data_semanal', $dataForm)){
                $filtro = '';
                foreach($dataForm['data_semanal'] as $data){
                    $filtro = $filtro.$data.',';
                }
                $query->where('data_semanal', 'like', '%'.$filtro.'%');
            }
            if(array_key_exists('nucleo_id', $dataForm)){
                $filtro = $dataForm['nucleo_id'];
                $query->where('nucleo_id', '=', '$filtro');
            }
        })->orderBy('nome')->paginate(10);
        Session::put('quant', 'Foram encontrados '.count($turmaslist).' turmas no banco de dados.');
        $nucleoslist = Nucleo::all();
        $dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];
        if($dataForm['id'] > 0){
            $professor = Professor::find($dataForm['id']);
            if($professor != null){
                $turmasprofessor = $professor->turmas;
                $turmaslist = $this->filtrar_dados($turmaslist, $turmasprofessor);
            }
            Session::put('turmaslist', $turmaslist);

            return redirect()->route('filtros_professor_turmas', $dataForm['id']);
        }
        elseif ($dataForm['id'] < 0) {
            $pessoa = Pessoa::find(-$dataForm['id']);
            foreach($pessoa->turmas as $p){
                $pessoasTurmas[] = $p->id;
            }

            return view ('pessoas_file.pessoas_turmas', compact('pessoa', 'turmaslist', 'pessoasTurmas', 'nucleoslist', 'dias_semana'));
        }
        else{
            return view ('turmas_file.turmas', compact('turmaslist', 'nucleoslist', 'dias_semana'));
        }
    }
}
