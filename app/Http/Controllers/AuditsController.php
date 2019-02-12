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
        Session::put('quant', count($auditall).' auditorias cadastradas.');
        $eventos = ['Criação','Edição','Exclusão'];
        $tabelas = ['Usuários','Professores','Clientes','Anamneses','Doenças','Turmas','Núcleos'];

        return view ('audits_file.audits', compact('auditslist','eventos','tabelas'));
    }

    public function info($id){
        $audit = Audit::find($id);
        $old = substr($audit->old_values, 0, 40);
        $audit += ['old_values1' => $old];
        $old = substr($audit->old_values, 41, 60);

        return view ('audits_file.audits_info', compact('audit'));
    }
}
