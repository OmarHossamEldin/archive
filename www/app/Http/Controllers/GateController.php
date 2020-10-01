<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GateController extends Controller
{
    public function home(){
        return view('login');
    }
   
}
