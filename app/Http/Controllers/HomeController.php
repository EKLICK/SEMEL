<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(is_null(auth()->user()->admin_professor)){
            return view ('auth.login');
        }
        else {
            if(auth()->user()->admin_professor == 1){
                return redirect()->route('pessoas.index');
            }
            else{
                return redirect()->route('professor_turmas', 1);
            }   
        }
    }
}
