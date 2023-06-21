<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index(){
        // $pegawai = Pegawai::all();
     
        return view ('front');
    }

   
}
