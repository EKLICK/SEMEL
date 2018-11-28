<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Audit;

class auditsController extends Controller
{
    public function index(){
        $auditslist = Audit::orderBy('created_at')->paginate(10);
        return view ('audits_file.audits', compact('auditslist'));
    }

    public function audits_info($id){
        $auditoria = Audit::find($id);
        return view ('historico_file.historicoVizualizar', compact('auditoria'));
    }
}
