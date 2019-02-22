<?php

namespace App\Http\Controllers\Ferramentas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//CONTROLE DE PDF:
//Comentarios em cima, código comentado em baixo.
class PDFController extends Controller{
    //FUNÇÕES DE REDIRECIONAMENTO:
    //Função index, retorna a página de registros de pdfs.
    public function index(){
        return view ('pdf');
    }
}
