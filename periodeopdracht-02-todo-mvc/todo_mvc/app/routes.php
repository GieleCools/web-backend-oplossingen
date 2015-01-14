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
Route::get('/login', 'AuthenticationController@getLogin')->before('guest'); //route enkel volgen als iemand nog niet ingelogd is
Route::post('login', 'AuthenticationController@postLogin')->before('csrf'); //beschermen tegen cross-site request forgeries van inlogform

