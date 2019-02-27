<?php

namespace App\Http\Middleware;

use Closure;

class Secretario{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $user = \Auth::user();
        if($user['id'] != 1){
            return redirect()->route('login');
        }

        return $next($request);
    }
}
