<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

//MODELOS PARA CONTROLE:
use App\Audit;

//CONTROLE DE AUDITORIAS:
//Comentarios em cima, código comentado em baixo.
class auditsController extends Controller{
    //FUNÇÕES DE REDIRECIONAMENTO:
    //Função index, retorna a página de registros de auditorias.
    public function index(){
        //Encontra todos os registros de auditorias e ordena por nome.
        $auditslist = Audit::orderBy('created_at','desc')->paginate(10);

        //Criando array de eventos para filtro.
        $eventos = ['Criação','Edição','Exclusão'];

        //Criando array de de tabelas para filtro.
        $tabelas = ['Quantidade limite','Usuários','Professores','Clientes','Anamneses','Doenças','Turmas','Núcleos'];

        //Define sessão count para informação de quantidade de registros.
        $count = Audit::all();
        Session::put('quant', count($count).' auditorias cadastradas.');

        return view ('audits_file.audits', compact('auditslist','eventos','tabelas'));
    }

    //Função pessoas_info: Seleciona informações necessarias para vizualização e retorna a página de informações de auditorias.
    public function info($id){
        //Encontra a auditoria no banco de dados.
        $audit = Audit::find($id);

        return view ('audits_file.audits_info', compact('audit'));
    }
}
