<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@getIndex');
Route::get('/login', 'AuthenticationController@getLogin');
Route::post('login', 'AuthenticationController@postLogin');

// Route::get('/', function()
// {
// 	return View::make('home');
// });


// Route::get('users', function()
// {
// 	//alle rows uit de users tabel halen
// 	$users = User::all();

// 	//with --> data doorgeven aan de view, params zijn keys en values 
//     return View::make('users')->with('users', $users);
// });

// //Route::get('users', 'UserController@getIndex');

// Route::get('user/{id}', 'UserController@showProfile');