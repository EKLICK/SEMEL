<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
        else{
            $rota = $request->route();
            if(($rota == 'editar_senha' || $rota == 'professor_meus_alunos') && auth()->user()->admin_professor == 1){
                return route('professores.index');
            }
            elseif (($rota != 'editar_senha' && $rota != 'professor_meus_alunos') && auth()->user()->admin_professor != 1) {
                return route('professor_turmas');
            }
        }
        dd($rota);
    }
}
