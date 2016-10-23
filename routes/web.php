<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});
Route::get('notes', function(){
    return view('notes');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/realm/active/{realm}', function($realm) {
    session(['realm' => $realm]);
    return redirect()->back();
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/hearth/{guid}', 'HearthstoneController@confirm');
    Route::post('/hearth/{guid}', 'HearthstoneController@hearth');

    Route::get('user/profile', function () {
        // Uses Auth Middleware
    });
});