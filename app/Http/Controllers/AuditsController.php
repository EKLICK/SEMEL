<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Audit;

class auditsController extends Controller
{
    public function index(){
        $auditslist = Audit::orderBy('created_at')->paginate(10);
        $auditall = Audit::all();
        Session::put('quant', 'Foram encontrados '.count($auditall).' auditorias no banco de dados.');

        return view ('audits_file.audits', compact('auditslist'));
    }

    public function info($id){
        $audit = Audit::find($id);

        return view ('audits_file.audits_info', compact('audit'));
    }
}
