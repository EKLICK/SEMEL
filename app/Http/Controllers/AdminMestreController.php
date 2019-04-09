<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//MODELOS PARA CONTROLE:
use App\User;

class AdminMestreController extends Controller{
    protected function secretario_register(Request $request){    
        return view ('auth.secretario.secretario_register');
    }

    protected function secretario_store(Request $request){
        $dataForm = $request->all();

        $userlist = User::all();

        foreach($userlist as $user){
            if($user->permissao == 2 && $user->deleted_at == null){
                $user->delete();
                break;
            }
        }

        User::create([
            'nick' => $dataForm['nick'],
            'name' => $dataForm['name'],
            'admin_professor' => 2,
            'email' => $dataForm['email'],
            'password' => Hash::make($dataForm['password']),
        ]);

        //Encontra todos os registros de usuários e ordena por nick.
        $userslist = User::withTrashed()->orderBy('nick')->where('permissao', '!=', 1)->paginate(10);

        //Encontra o número definido como limite de quantidade de turmas que uma pessoa pode ter no sistema.
        $quantidade = Quant::find(1);

        //Define um sessão em verde para informar a criação do usuário.
        Session::put('mensagem_green', "Secretario criado com sucesso!");
        
        return view ('auth.users', compact('userslist','quantidade'));
    }
}
