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

    public function professores_softdeletes(){
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
        $dataForm = $request->all();
        $pessoaslist = Pessoa::onlyTrashed()->where(function($query) use($dataForm){;
            if(!empty($dataForm['nome'])){
                $filtro = $dataForm['nome'];
                $query->where('nome', 'like', $filtro."%");
            }
            if(!empty($dataForm['de'])){
                $filtro = explode(' ',$dataForm['de']);
                list($dia, $mes, $ano) = explode('/', $filtro[0]);
                $nascimento = $ano.'-'.$mes.'-'.$dia.' 00:00:00';
                $query->where('nascimento',  '>=', $nascimento);
            }
            if(!empty($dataForm['ate'])){
                $filtro = explode(' ',$dataForm['ate']);
                list($dia, $mes, $ano) = explode('/', $filtro[0]);
                $nascimento = $ano.'-'.$mes.'-'.$dia.' 00:00:00';
                $query->where('nascimento',  '<=', $nascimento);
            }
            if(!empty($dataForm['rg'])){
                $filtro = $dataForm['rg'];
                $query->where('rg', 'like', $filtro."%");
            }
            if(!empty($dataForm['cpf'])){
                $filtro = $dataForm['cpf'];
                $query->where('cpf', 'like', $filtro."%");
            }
            if(!empty($dataForm['bairro'])){
                $filtro = $dataForm['bairro'];
                $query->where('bairro', 'like', $filtro."%");
            }
            if(!empty($dataForm['rua'])){
                $filtro = $dataForm['rua'];
                $query->where('rua', 'like', $filtro."%");
            }
            if(!empty($dataForm['telefone'])){
                $filtro = $dataForm['telefone'];
                $query->where('telefone', 'like', $filtro."%");
            }
            if(!empty($dataForm['sexo'])){
                $filtro = $dataForm['sexo'];
                $query->where('sexo', 'like', $filtro."%");
            }
            if(!empty($dataForm['estado_civil'])){
                $filtro = $dataForm['estado_civil'];
                $query->where('estado_civil', 'like', $filtro."%");
            }
        })->orderBy('nome')->paginate(10);
        Session::put('quant', 'Foram encontrados '.count($pessoaslist).' pessoas no banco de dados.');
        $ano = date('Y');

        return view ('pessoas_file.pessoas_softdeletes', compact('pessoaslist', 'ano'));
    }

    public function professor_procurar_softdelete(Request $request){
        $dataForm = array_filter($request->all());
        $turmaslist = Turma::all();
        
        $professoreslist = Professor::onlyTrashed()->where(function($query) use($dataForm){
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
            if(array_key_exists('email', $dataForm)){
                $filtro = $dataForm['email'];
                $useremails= User::onlyTrashed()->where('email', 'like', $filtro)."%"->where('admin_professor', '=', 0);
                $query->where('user_id', '=', $useremails->id);
            }
            if(array_key_exists('matricula', $dataForm)){
                $filtro = $dataForm['matricula'];
                $query->where('matricula', 'like', $filtro."%");
            }
            if(array_key_exists('telefone', $dataForm)){
                $filtro = $dataForm['telefone'];
                $query->where('telefone', 'like', $filtro."%");
            }
            if(array_key_exists('bairro', $dataForm)){
                $filtro = $dataForm['bairro'];
                $query->where('bairro', 'like', $filtro."%");
            }
            if(array_key_exists('rua', $dataForm)){
                $filtro = $dataForm['rua'];
                $query->where('rua', 'like', $filtro."%");
            }
        })->orderBy('nome')->paginate(10);
        Session::put('quant', 'Foram encontrados '.count($professoreslist).' professores no banco de dados.');

        return view ('professores_file.professores_softdeletes', compact('professoreslist'));
    }
}
