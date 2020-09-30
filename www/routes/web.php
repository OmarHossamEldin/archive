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

Route::resources([
    'suitcase' => SuitCaseController::class,
    'document' => DocumentController::class,
    'organization' => OrganizationController::class,
    'subject' => SubjectController::class,
]);

Route::group(['prefix' => 'search'], function () {
    Route::get('/document/{keyword}','DocumentController@search');
    Route::get('/subject/{keyword}','SubjectController@search');
    Route::get('/suitcase/{keyword}','SuitCaseController@search');
    Route::get('/organization/{keyword}','OrganizationController@search');
});

Route::group(['prefix' => 'database'], function () {
    Route:post('/backup', 'DatabaseBackupController@backup');
    Route::post('/restore', 'DatabaseBackupController@restore');

    });

Route::get('/','GateController@home')->name('login'); // HomePage => loginForm

});
