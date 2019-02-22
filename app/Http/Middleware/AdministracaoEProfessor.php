<?php

namespace App\Http\Middleware;

use Closure;

class AdministracaoEProfessor{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $user = \Auth::user();
        if($user['admin_professor'] == 0){
            return redirect()->route('login');
        }

        return $next($request);
    }
}
