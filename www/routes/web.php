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

//Authenticated
Route::group(['middleware' => 'auth'], function () {

    Route::get('/logout', 'GateController@logout')->name('logout');

    Route::get('/backup/view','DatabaseBackupController@index')->name('backup.view');
    Route::get('/organization/tree', 'OrganizationController@tree');
    Route::post('/document/serial', 'DocumentController@serial');
    Route::get('/suitcase/activate/{id}', 'SuitCaseController@activate');

    Route::resources([
        'suitcase' => SuitCaseController::class,
        'document' => DocumentController::class,
        'organization' => OrganizationController::class,
        'subject' => SubjectController::class,
    ]);

    Route::group(['prefix' => 'search'], function () {
        Route::post('/document', 'DocumentController@search');
        Route::get('/subject/{keyword}', 'SubjectController@search');
        Route::get('/suitcase/{keyword}', 'SuitCaseController@search');
        Route::get('/organization/{keyword}', 'OrganizationController@search');
    });


    Route::group(['prefix' => 'database'], function () {
        Route::get('/backup', 'DatabaseBackupController@backup');
        Route::post('/restore', 'DatabaseBackupController@restore');
    });
});

//UnAuthenticated
Route::group(['middleware' => 'guest'], function () {

    Route::get('/', 'GateController@home')->name('login.form'); // HomePage => loginForm

    Route::post('/login', 'GateController@login')->name('login'); // login to the app
});
