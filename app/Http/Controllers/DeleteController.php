<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Professor;
use App\Pessoa;


class DeleteController extends Controller
{
    public function pessoas_softdeletes(){
        $pessoaslist = Pessoa::onlyTrashed()->paginate(10);
        $data = new \DateTime();
        $ano = date('Y');
        Session::put('quant', 'Foram encontrados '.count($pessoaslist).' pessoas deletadas no banco de dados.');
        
        return view ('pessoas_file.pessoas_softdeletes', compact('pessoaslist', 'ano'));
    }

    public function professor_softdeletes(){
        $professoreslist = Professor::onlyTrashed()->paginate(10);
        Session::put('quant', 'Foram encontrados '.count($professoreslist).' professores deletadas no banco de dados.');
        
        return view ('professores_file.professores_softdeletes', compact('professoreslist'));
    }

    public function pessoas_restore($id){
        $pessoaslist = Pessoa::onlyTrashed()->get();
        $pessoa = $pessoaslist->find($id);

        $pessoa->restore();

        return redirect()->route('pessoas.index');
    }

    public function professores_restore($id){
        $professoreslist = Professor::onlyTrashed()->get();
        $professor = $professoreslist->find($id);

        $userslist = User::onlyTrashed()->get();
        $user = $userslist->where('id', '=', $professor->user_id)->last();
        $user->restore();
        $professor->restore();

        return redirect()->route('professor.index');
    }

    public function pessoas_procurar_softdelete(Request $request){
        $dataForm = array_filter($request->all());
        $pessoaslist = Pessoa::onlyTrashed()->where(function($query) use($dataForm){;
            if(array_key_exists('nome', $dataForm)){
                $filtro = $dataForm['nome'];
                $query->where('nome', 'like', $filtro."%");
            }
            if(array_key_exists('de', $dataForm)){
                $filtro = explode(' ',$dataForm['de']);
                list($dia, $mes, $ano) = explode('/', $filtro[0]);
                $nascimento = $ano.'-'.$mes.'-'.$dia.' 00:00:00';
                $query->where('nascimento',  '>=', $nascimento);
            }
            if(array_key_exists('ate', $dataForm)){
                $filtro = explode(' ',$dataForm['ate']);
                list($dia, $mes, $ano) = explode('/', $filtro[0]);
                $nascimento = $ano.'-'.$mes.'-'.$dia.' 00:00:00';
                $query->where('nascimento',  '<=', $nascimento);
            }
            if(array_key_exists('rg', $dataForm)){
                $filtro = $dataForm['rg'];
                $query->where('rg', 'like', $filtro."%");
            }
            if(array_key_exists('cpf', $dataForm)){
                $filtro = $dataForm['cpf'];
                $query->where('cpf', 'like', $filtro."%");
            }
            if(array_key_exists('bairro', $dataForm)){
                $filtro = $dataForm['bairro'];
                $query->where('bairro', 'like', $filtro."%");
            }
            if(array_key_exists('rua', $dataForm)){
                $filtro = $dataForm['rua'];
                $query->where('rua', 'like', $filtro."%");
            }
            if(array_key_exists('telefone', $dataForm)){
                $filtro = $dataForm['telefone'];
                $query->where('telefone', 'like', $filtro."%");
            }
            if(array_key_exists('sexo', $dataForm)){
                $filtro = $dataForm['sexo'];
                $query->where('sexo', 'like', $filtro."%");
            }
            if(array_key_exists('estado_civil', $dataForm)){
                $filtro = $dataForm['estado_civil'];
                $query->where('estado_civil', 'like', $filtro."%");
            }
        })->orderBy('nome')->paginate(10);
        Session::put('quant', 'Foram encontrados '.count($pessoaslist).' pessoas no banco de dados.');
        $ano = date('Y');

        return view ('pessoas_file.pessoas_softdeletes', compact('pessoaslist', 'ano'));
    }
}
