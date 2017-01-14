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


Auth::routes();
Route::resource('posts', 'PostController');
Route::resource('checkup', 'CheckupController');
Route::resource('immunization', 'ImmunizeController');
Route::get('search', [
    'as' => 'posts.search', 'uses' => 'PostController@search'
]);

Route::get('pdf/{id}', [
    'as' => 'posts.pdf', 'uses' => 'PostController@pdf'
]);

Route::get('/', function(){
	return view('auth/login');
});
