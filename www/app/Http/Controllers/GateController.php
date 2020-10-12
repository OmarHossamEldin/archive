<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Lang;

class GateController extends Controller
{
    public function home(){
        return view('login');
    }

    public function login(Request $request)
    {
        $ValidatedData=$request->validate([
            'password'=>'required|min:8'
        ]);
        $ValidatedData['username']='admin';

        if(Auth::attempt($ValidatedData))
        {
            return redirect('\document')->with('success',Lang::get('archive.global.login.success'));
        }
        else
        {
            return back()->with('error',Lang::get('archive.global.login.error'));
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success',Lang::get('archive.global.logout'));
    }
   
}
