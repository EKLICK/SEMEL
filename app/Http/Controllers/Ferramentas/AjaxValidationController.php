<?php

namespace App\Http\Controllers\Ferramentas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Pessoa;
use App\Professor;

class AjaxValidationController extends Controller{
    public function cpfValidation(Request $request){
        $dataForm = $request->all();

        $listacpfpessoas = Pessoa::all('cpf');
        $listacpfprofessores = Professor::all('cpf');
        
        $listacpfs = [];

        foreach($listacpfpessoas as $cpf){
            array_push($listacpfs, $cpf['cpf']);
        }
        foreach($listacpfprofessores as $cpf){
            array_push($listacpfs, $cpf['cpf']);
        }

        if(isset($dataForm['id'])){
            if($dataForm['tabela'] == 1){
                $id = Pessoa::find($dataForm['id']);
            }
            else{
                $id = Professor::find($dataForm['id']);
            }

            unset($listacpfs[array_search($id['cpf'], $listacpfs)]);
        }
        
        return response()->json(!in_array($dataForm['cpf'], $listacpfs));
    }


    public function rgValidation(Request $request){
        $dataForm = $request->all();

        $listargpessoas = Pessoa::all('rg');
        $listargprofessores = Professor::all('rg');
        
        $listargs = [];

        foreach($listargpessoas as $rg){
            array_push($listargs, $rg['rg']);
        }
        foreach($listargprofessores as $rg){
            array_push($listargs, $rg['rg']);
        }
        
        if(isset($dataForm['id'])){
            if($dataForm['tabela'] == 1){
                $id = Pessoa::find($dataForm['id']);
            }
            else{
                $id = Professor::find($dataForm['id']);
            }
            
            unset($listargs[array_search($id['rg'], $listargs)]);
        }
        
        return response()->json(!in_array($dataForm['rg'], $listargs));
    }

    public function emailValidation(Request $request){
        $dataForm = $request->all();

        if($dataForm['tabela'] == 1){
            $listar = Professor::all('email');
        }
        else{
            $listar = User::all('email');
        }
        
        $listaemails = [];

        foreach($listar as $email){
            array_push($listaemails, $email['email']);
        }
        
        if(isset($dataForm['id'])){
            if($dataForm['tabela'] == 1){
                $id = Professor::find($dataForm['id']);
            }
            else{
                $id = User::withTrashed()->find($dataForm['id']);
            }
            unset($listaemails[array_search($id['email'], $listaemails)]);
        }
        
        return response()->json(!in_array($dataForm['email'], $listaemails));
    }

    public function matriculaValidation(Request $request){
        $dataForm = $request->all();

        $listargprofessores = Professor::all('matricula');
        
        $listamatriculas = [];

        foreach($listargprofessores as $email){
            array_push($listamatriculas, $matricula['matricula']);
        }
        
        if(isset($dataForm['id'])){
            $id = Professor::find($dataForm['id']);
            unset($listamatriculas[array_search($id['matricula'], $listamatriculas)]);
        }
        
        return response()->json(!in_array($dataForm['matricula'], $listamatriculas));
    }
}
