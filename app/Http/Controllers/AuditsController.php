<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Audit;

class auditsController extends Controller{
    //Funções de Redirecionamento
    public function index(){
        $auditslist = Audit::orderBy('created_at','desc')->paginate(10);
        $auditall = Audit::all();
        Session::put('quant', count($auditall).' auditorias cadastradas.');
        $eventos = ['Criação','Edição','Exclusão'];
        $tabelas = ['Quantidade limite','Usuários','Professores','Clientes','Anamneses','Doenças','Turmas','Núcleos'];

        return view ('audits_file.audits', compact('auditslist','eventos','tabelas'));
    }

    public function info($id){
        $audit = Audit::find($id);

        return view ('audits_file.audits_info', compact('audit'));
    }
}
