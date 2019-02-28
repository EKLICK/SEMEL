<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Session;

use App\Http\Requests\User\UserEditFormRequest;

use App\User;
use App\Professor;
use App\Nucleo;
use App\Turma;
use App\Pessoa;
use App\HistoricoPT;
use App\Quant;

class RegisterController extends Controller{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){}

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data){
        return Validator::make($data, [
            'nick' => ['required','regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/','between:5,50'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ]);
    }

    protected function index(){
        $userslist = User::orderBy('nick')->where('id', '!=', 1)->get();

        //Encontra o número definido como limite de quantidade de turmas que uma pessoa pode ter no sistema.
        $quantidade = Quant::find(1);

        return view ('auth.users', compact('userslist','quantidade'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data){
        Session::put('mensagem_green', 'Administrador '.$data['name'].' adicionado com sucesso!');
        return User::create([
            'nick' => $data['nick'],
            'name' => $data['name'],
            'admin_professor' => 1,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function edit($id){
        $user = User::find($id);

        return view('auth.users_edit', compact('user'));
    }

    protected function update(UserEditFormRequest $request, $id){
        $dataForm = $request->all();
        $user = User::find($id);

        if($dataForm['password_antiga'] != null && $dataForm['usuario_antigo'] != null){
            if((!Hash::check($dataForm['password'], $user->password)) || ($user->name != $dataForm['usuario'])){
                Session::put('mensagem_red', "Usuário ou senha incorreta para troca de senha!");

                return redirect()->Route('users.edit', $id);
            }
            else{
                $user->update([
                    'nick' => $dataForm['nick'],
                    'email' => $dataForm['email'],
                    'name' => $dataForm['usuario'],
                    'password' => bcrypt($dataForm['password']),
                ]);
            }
        }
        else{
            $user->update([
                'nick' => $dataForm['nick'],
                'email' => $dataForm['email'],
            ]);
        }

        $professor = Professor::where('user_id', '=', $id)->get()->last();
        $professor->update(['email' => $dataForm['email']]);
        
        return redirect()->Route('users.index');
    }

    protected function destroy(Request $request){
        $dataForm = $request->all();
        if($dataForm['id'] != 1){
            $user = User::find($dataForm['id']);

            $user->delete();

            Session::put('mensagem_green', "Usuário deletado com sucesso!");
        }

        return redirect()->Route('users.index');
    }

    protected function reset(Request $request){
        $dataForm = $request->all();
        
        $user = User::find(1);

        if((!Hash::check($dataForm['password'], $user['password'])) || ($user->name != $dataForm['name'])){
            Session::put('mensagem_red', "Usuário ou senha incorreta para resetar!");
        }
        else{
            $nucleolist = Nucleo::where('inativo', '=', 1)->get();

            foreach($nucleolist as $nucleo){
                foreach($nucleo->turmas as $turma){
                    if($turma['inativo'] == 1){
                        foreach($turma->pessoas as $pessoa){
                            if($pessoa->pivot->inativo == 1){
                                DB::update(DB::raw('UPDATE turmas_pessoas SET inativo = 2 WHERE pessoa_id ='.$pessoa->id.' AND turma_id = '.$turma->id));

                                HistoricoPT::create([
                                    'pessoa_id' => $pessoa->id,
                                    'turma_id' => $turma->id,
                                    'comentario' => 'Pessoa inativada devido ao reset do sistema.',
                                    'inativo' => 2,
                                ]);
                            }
                        }
                    }
                }
            }

            Session::put('mensagem_green', "Todas as pessoas resetadas com sucesso!");
        }

        return redirect()->Route('users.index');
    }

    //Função define_quantidade: Define quantidade limite de turmas que uma pessoa pode ter no sistema.
    protected function define_quantidade(Request $request){
        $dataForm = $request->all();

        //Função acessivel apenas para o administrador 1, caso não seja o administrador 1, será bloqueado destas ações.
        if(auth()->user()->id == 1){
            //Busca a quantidade atual de limite de turmas que um pessoa pode ter no sistema.
            $quant = Quant::find(1);

            //Edita quantidade no banco de dados:
            $quant->update($dataForm);
        }

        return redirect()->route('users.index');
    }
}
