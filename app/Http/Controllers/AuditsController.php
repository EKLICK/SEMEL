<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Audit;

class auditsController extends Controller
{
    //Funções de Redirecionamento
    public function index(){
        $auditslist = Audit::orderBy('created_at')->paginate(10);
        $auditall = Audit::all();
        Session::put('quant', 'Foram encontrados '.count($auditall).' auditorias no banco de dados.');
        $eventos = ['Criação','Edição','Exclusão'];
        $tabelas = ['Usuários','Professores','Clientes','Anamneses','Doenças','Turmas','Núcleos'];

        return view ('audits_file.audits', compact('auditslist','eventos','tabelas'));
    }

    public function info($id){
        $audit = Audit::find($id);

        return view ('audits_file.audits_info', compact('audit'));
    }

    public function audits_procurar(Request $request){
        $dataForm = $request->all();
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
        })->paginate(10);
        Session::put('quant', 'Foram encontrados '.count($auditslist).' Auditorias no banco de dados.');
        $eventos = ['Criação','Edição','Exclusão'];
        $tabelas = ['Usuários','Professores','Clientes','Anamneses','Doenças','Turmas','Núcleos'];
        
        return view('audits_file.audits', compact('auditslist', 'eventos', 'tabelas'));
    }
}
