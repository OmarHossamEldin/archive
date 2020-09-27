<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        $ValidatedData=$request->validate([
            'username'=>'required',
            'password'=>'required|min:8'
        ]);
        
        if(Auth::attempt($ValidatedData))
        {
            return response()->json(['user'=>Auth::user(),'api_token' =>Auth::user()->ApiTokenGenerater()], 201);
        }
        else
        {
            return response()->json(['type'=>'error','message' => 'Your Credentials Are Wrong'], 400);
        }
    }

    public function anwser(Request $request){

        $ValidatedData=$request->validate([
            'key'=>'required|numeric',
            'answer'=>'required'
        ]);
        Auth::guard('api')->user()->SaftyQuestion()->create($ValidatedData);
        return response()->json(['type'=>'success','message' => 'Your Answer Has Been Saved'], 201);
        
    }

    public function logout(Request $request){
        $user = Auth::guard('api')->user();
        if ($user) {
            $user->api_token = null;
            $user->save();
        }
        return response()->json(['type'=>'sucess','message' => 'User Logged Out.'], 200);
    }

    public function show(){

        return Auth::user();
    }
}
