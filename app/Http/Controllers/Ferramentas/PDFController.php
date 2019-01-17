<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Audits;

class PDFController extends Controller
{
    public function index(){
        return view ('pdf');
    }
}
