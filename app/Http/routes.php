<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/home', 'HomeController@index');
    Route::get('/account', 'AccountsController@index');
    Route::get('/account/edit/{id}', 'AccountsController@edit');
    Route::post('/account/update', 'AccountsController@update');
    Route::post('/account/store', 'AccountsController@store');
    Route::get('/account/create', 'AccountsController@create');
    Route::get('/transaction/account/{id}', 'TransactionsController@accountlist');
    Route::get('/transaction/create/account/{id}', 'TransactionsController@create');
    Route::post('/transaction/store', 'TransactionsController@store');
    Route::get('/category', 'CategoriesController@index');
});