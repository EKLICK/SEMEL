<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\Nucleo\NucleoCreateEditFormRequest;
use App\Http\Requests\Nucleo\NucleoProcurarFormRequest;
use Illuminate\Support\Facades\DB;
use App\Nucleo;
use App\Turma;
use App\HistoricoN;
use App\Professor;
use Illuminate\Support\Facades\Session;

class NucleosController extends Controller
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
        $bairroslist = ['ARROIO DA MANTEIGA','BOA VISTA','CAMPESTRE','CAMPINA','CENTRO','CRISTO REI','DUQUE DE CAXIAS',
                        'FAZENDA SAO BORJA','FEITORIA','FIAO','JARDIM AMERICA','MORRO DO ESPELHO','PADRE REUS','PINHEIRO',
                        'RIO BRANCO','RIO DOS SINOS','SANTA TEREZA','SANTO ANDRE','SANTOS DUMONT','SAO JOAO BATISTA',
                        'SAO JOSE','SAO MIGUEL','SCHARLAU','VICENTINA'];
        $nucleoslist = Nucleo::orderBy('nome')->paginate(10);
        Session::put('quant', count($nucleoall).' núcleos cadastrados.');

        return view ('nucleos_file.nucleos', compact('nucleoslist', 'bairroslist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bairroslist = ['ARROIO DA MANTEIGA','BOA VISTA','CAMPESTRE','CAMPINA','CENTRO','CRISTO REI','DUQUE DE CAXIAS',
                        'FAZENDA SAO BORJA','FEITORIA','FIAO','JARDIM AMERICA','MORRO DO ESPELHO','PADRE REUS','PINHEIRO',
                        'RIO BRANCO','RIO DOS SINOS','SANTA TEREZA','SANTO ANDRE','SANTOS DUMONT','SAO JOAO BATISTA',
                        'SAO JOSE','SAO MIGUEL','SCHARLAU','VICENTINA'];
        return view ('nucleos_file.nucleos_create', compact('bairroslist'));
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
        $bairroslist = ['ARROIO DA MANTEIGA','BOA VISTA','CAMPESTRE','CAMPINA','CENTRO','CRISTO REI','DUQUE DE CAXIAS',
                        'FAZENDA SAO BORJA','FEITORIA','FIAO','JARDIM AMERICA','MORRO DO ESPELHO','PADRE REUS','PINHEIRO',
                        'RIO BRANCO','RIO DOS SINOS','SANTA TEREZA','SANTO ANDRE','SANTOS DUMONT','SAO JOAO BATISTA',
                        'SAO JOSE','SAO MIGUEL','SCHARLAU','VICENTINA'];
        return view ('nucleos_file.nucleos_edit', compact('nucleo','bairroslist'));
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
        $dataForm += ['inativo' => $nucleo->inativo];
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
        $histnucleo = HistoricoN::orderBy('created_at', 'desc')->where('nucleo_id', '=', $nucleo->id)->paginate(6);
        $a = count(DB::select(DB::raw('SELECT * FROM Pessoas WHERE 
                                                        id IN(SELECT Pessoa_id FROM Turmas_pessoas WHERE 
                                                            Turma_id IN(SELECT Turma_id FROM Nucleos WHERE 
                                                                id = '.$id.')) GROUP BY id')));
        $b = count(DB::select(DB::raw('SELECT * FROM Pessoas WHERE 
                                                        id IN(SELECT Pessoa_id FROM Turmas_pessoas WHERE 
                                                            Turma_id IN(SELECT Turma_id FROM Nucleos WHERE 
                                                                id = '.$id.') and inativo = 1) GROUP BY id')));
        $c = $a - $b;
        $dadosgerais = [$a,$b,$c];
        if(auth()->user()->admin_professor == 0){
            $professor = Professor::where('user_id', '=', auth()->user()->id)->first();
            return view ('nucleos_file.nucleos_info', compact('nucleo','histnucleo','dadosgerais','professor'));
        }
        return view ('nucleos_file.nucleos_info', compact('nucleo','histnucleo','dadosgerais'));
    }

    public function nucleos_ativar_inativar(Request $request){
        $dataForm = $request->all();
        $nucleo = Nucleo::find($dataForm['nucleo_id']);
        if($nucleo->inativo == 1){
            $nucleo->update(['inativo'=>2]);
            $dataForm += ['inativo' => 2];
            Session::put('mensagem', $nucleo->nome . " foi inativado com sucesso!");
        }
        else{
            $nucleo->update(['inativo'=>1]);
            $dataForm += ['inativo' => 1];
            Session::put('mensagem', $nucleo->nome . " foi ativado com sucesso!");
        }
        HistoricoN::create($dataForm);

        return redirect()->Route('nucleos.index');
    }
}
