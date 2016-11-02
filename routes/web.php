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
    $announce = \App\Announcement::where('realm_id', -1)->latest()->first();
    return view('welcome', compact('announce'));
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
});

Route::group(['prefix' => 'admin', 'middleware' => 'can:admin,App\Realm'], function () {
    Route::get('realms', 'RealmController@index');
    Route::get('realms/edit/{realmid}', 'RealmController@edit');
    Route::post('realms', 'RealmController@update');
    Route::get('permissions', 'PermissionsController@index');
    Route::post('permissions', 'PermissionsController@update');
});

Route::group(['prefix' => 'gm', 'middleware' => 'can:gm,App\Realm'], function () {
    Route::get('announce', 'AnnouncementController@index');
    Route::get('announce/add', 'AnnouncementController@add');
    Route::post('announce', 'AnnouncementController@create');
    Route::get('announce/{announcement}/edit', 'AnnouncementController@edit');
    Route::post('announce/{announcement}', 'AnnouncementController@update');
    Route::get('announce/{announcement}/delete', 'AnnouncementController@confirmDelete');
    Route::post('announce/{announcement}/delete', 'AnnouncementController@delete');
});

Route::group(['prefix' => 'mod', 'middleware' => 'can:moderator,App\Realm'], function () {
    //
});