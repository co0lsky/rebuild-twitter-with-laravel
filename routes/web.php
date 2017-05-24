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

Route::group(['middleware' => 'auth'], function () {
	Route::get('/timeline', 'ShowTimeline');
	Route::post('/tweet', 'PostTweet');
	Route::get('/following', 'ProfileController@following')->name('following');
    Route::post('/follows', 'UserController@follows');
    Route::post('/unfollows', 'UserController@unfollows');
});

Route::get('/{username}', 'ProfileController@show')->name('profile');
Route::get('/{username}/followers', 'ProfileController@followers')->name('followers');
