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

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/{username}', 'ProfileController@show');
Route::get('/following', 'ProfileController@following');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/follows/{username}', 'UserController@follows');
    Route::get('/unfollows/{username}', 'UserController@unfollows');
});
