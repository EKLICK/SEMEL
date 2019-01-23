<?php

namespace App\Http\Controllers\Ferramentas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Audits;

class PDFController extends Controller
{
    public function index(){
        return view ('pdf');
    }
}
