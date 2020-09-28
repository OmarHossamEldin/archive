<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix','/'],function(){
    
    //Authenticated
    Route::group(['middleware'=>'auth'],function(){
    
    });
    //UnAuthenticated
    Route::group(['middleware'=>'guest'],function(){

        Route::get('/','GateController@home')->name('login'); // HomePage => loginForm

    });
   
});

