<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Requests\Pessoa\PessoaProcurarFormRequest;
use App\Pessoa;
use App\Bairro;


class DeleteController extends Controller
{
    public function pessoas_softdeletes(){
        $bairroslist = Bairro::all();
        $pessoaslist = Pessoa::onlyTrashed()->paginate(10);
        $data = new \DateTime();
        $ano = date('Y');
        Session::put('quant', 'Foram encontrados '.count($pessoaslist).' pessoas deletadas no banco de dados.');
        
        return view ('pessoas_file.pessoas_softdeletes', compact('pessoaslist','bairroslist', 'ano'));
    }

    public function pessoas_restore($id){
        $pessoaslist = Pessoa::onlyTrashed()->get();
        $pessoa = $pessoaslist->find($id);
        $pessoa->restore();

        return redirect()->route('pessoas.index');
    }
}
