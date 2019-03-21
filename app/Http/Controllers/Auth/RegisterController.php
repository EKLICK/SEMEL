<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\RegistersUsers;

//REQUEST PARA CONTROLE:
use App\Http\Requests\User\UserCreateFormRequest;
use App\Http\Requests\User\UserEditFormRequest;

//MODELOS PARA CONTROLE:
use App\User;
use App\Professor;
use App\Nucleo;
use App\Turma;
use App\Pessoa;
use App\Quant;
use App\HistoricoPT;

//CONTROLE DE REGISTROS:
//Comentarios em cima, código comentado em baixo.
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

    //FUNÇÃO DE FERRAMENTAS:
    //Ferramenta validator: Valida usuário registrado para a criação.
    //Não utilizado no sistema atualmente.
    protected function validator(array $data){
        return Validator::make($data, [
            'nick' => ['required','regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/','between:5,50'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ]);
    }

    //Função index: Retorna a página de registros de usuários.
    protected function index(){
        //Encontra todos os registros de usuários e ordena por nick.
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

    //Função create: Retorna a página de criação de registros de usuários.
    protected function create(UserCreateFormRequest $request){
        $dataForm = $request->all();
        
        //Define sessão de informação para apresentação na página.
        Session::put('mensagem_green', 'Administrador '.$dataForm['name'].' adicionado com sucesso!');

        //Cria histórico no banco de dados.
        User::create([
            'nick' => $dataForm['nick'],
            'name' => $dataForm['name'],
            'admin_professor' => 1,
            'email' => $dataForm['email'],
            'password' => Hash::make($dataForm['password']),
        ]);

        //Encontra todos os registros de usuários e ordena por nick.
        $userslist = User::orderBy('nick')->where('id', '!=', 1)->get();

        //Encontra o número definido como limite de quantidade de turmas que uma pessoa pode ter no sistema.
        $quantidade = Quant::find(1);
        
        return view ('auth.users', compact('userslist','quantidade'));
    }

    //Função edit: Retorna a página de edição de registros de usuários.
    protected function edit($id){
        //Encontra a usuário no banco de dados.
        $user = User::find($id);

        return view('auth.users_edit', compact('user'));
    }

    //Função update: Faz as mudanças necessarias para adicionar no banco de dados e retorna a página de index.
    protected function update(UserEditFormRequest $request, $id){
        $dataForm = $request->all();

        //Encontra a usuário no banco de dados.
        $user = User::find($id);

        //Para editar a senha do usuário, é necessario confirma o usuário e senha antiga.
        //Verifica se os parametros para redefinição de senha foram passados.
        if($dataForm['password_antiga'] != null && $dataForm['name'] != null){
            //Se sim, verifica se os parametros correspondem ao login do usuário.
            if((Hash::check($dataForm['password'], $user->password)) && ($user->name == $dataForm['name'])){
                //Se sim, atualiza o usuário no banco de dados utilizando parametros de mudança de senha.
                $user->update([
                    'nick' => $dataForm['nick'],
                    'email' => $dataForm['email'],
                    'password' => bcrypt($dataForm['password']),
                ]);
            }
            else{
                //Se não, define uma sessão em vermelho para aviso de senha ou usuário incorreto.
                Session::put('mensagem_red', "Usuário ou senha incorreta para troca de senha!");

                return redirect()->Route('users.edit', $id);
            }
        }
        else{
            //Se não, atualiza o usuário no banco de dados sem mudar senha.
            $user->update([
                'nick' => $dataForm['nick'],
                'email' => $dataForm['email'],
            ]);
        }

        //Verifica se o usuário editado é professor.
        if($user->admin_professor == 0){
            //Se sim, muda o parametro de email no professor para o informado.
            $professor = Professor::where('user_id', '=', $id)->get()->last();
            $professor->update(['email' => $dataForm['email']]);
        }
        
        return redirect()->Route('users.index');
    }

    //Função destroy: Deleta o usuário.
    protected function destroy(Request $request){
        $dataForm = $request->all();

        //Verifica se o usuário a ser deletado possui o id diferente de 1
        if($dataForm['id'] != 1){
            //Se sim, encontra o usuário no banco de dados.
            $user = User::find($dataForm['id']);

            //Deleta o usuário
            $user->delete();

            //Define um sessão em verde para informar a exclusão do usuário.
            Session::put('mensagem_green', "Usuário deletado com sucesso!");
        }

        return redirect()->Route('users.index');
    }

    //Função reset: Inativa todas as pessoas de todas as turmas do sistema.
    protected function reset(Request $request){
        $dataForm = $request->all();
        
        //Encontra o usuário 1 no banco de dados.
        $user = User::find(1);

        //Verifica se o usuário possui os parametros corretos para a utilização da ferramenta.
        if((Hash::check($dataForm['password'], $user['password'])) && ($user->name == $dataForm['name'])){
            //Encontra todos os núcleos que estão ativos.
            $nucleolist = Nucleo::where('inativo', '=', 1)->get();

            //Percorre todos os núcleos que foram encontrados.
            foreach($nucleolist as $nucleo){
                //Percorre todas as turmas dos núcleos que foram encontrados.
                foreach($nucleo->turmas as $turma){
                    //Verifica se a turma está ativa.
                    if($turma['inativo'] == 1){
                        //Se sim, percorre todas as pessoas que estão na turma
                        foreach($turma->pessoas as $pessoa){
                            //Verifica se a pessoa está ativa na turma.
                            if($pessoa->pivot->inativo == 1){
                                //Se sim, edita o campo 'inativo' da tabela de turmas_pessoas para 2 , informando que está inativo.
                                DB::update(DB::raw('UPDATE turmas_pessoas SET inativo = 2 WHERE pessoa_id ='.$pessoa->id.' AND turma_id = '.$turma->id));

                                //Adiciona registro de alteração no histórico de pessoas e turmas.
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

            //Define uma sessão em verde para informar a conclusão da função.
            Session::put('mensagem_green', "Todas as pessoas resetadas com sucesso!");
        }
        else{
            //Se não, define uma sessão em vermelho para aviso de senha ou usuário incorreto.
            Session::put('mensagem_red', "Usuário ou senha incorreta para resetar!");
        }

        return redirect()->Route('users.index');
    }

    //Função define_quantidade: Define quantidade limite de turmas que uma pessoa pode ter no sistema.
    protected function define_quantidade(Request $request){
        $dataForm = $request->all();

        //Função acessivel apenas para o administrador 1, caso não seja o administrador 1, será bloqueado destas ações.
        if(auth()->user()->id == 1){
            //Se o número passado for menor que 1, define o número 1 na quantidade máxima.
            if($dataForm['quantidade'] < 1){ $dataForm['quantidade'] = 1;}

            //Busca a quantidade atual de limite de turmas que um pessoa pode ter no sistema.
            $quant = Quant::find(1);

            //Edita quantidade no banco de dados:
            $quant->update($dataForm);
        }

        return redirect()->route('users.index');
    }
}
