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

//home
//registreer
//login
//logout
//dashboard
//todo app

//home
Route::get('/', 'HomeController@getIndex'); 				
//Route::post('postIndex', 'HomeController@postIndex'); 						//postIndex ipv '/' --> bug? submit (post) naar eigen pagina werkt niet als de app in een subfolder zit

//login
Route::get('/login', 'AuthenticationController@getLogin')->before('guest'); 	//route-filter: route enkel volgen als iemand nog niet ingelogd is --> als je ingelogd bent, mag je nt meer naar inlogscherm k gaan
Route::post('/login', 'AuthenticationController@postLogin')->before('csrf'); 	//beschermen tegen cross-site request forgeries van inlogform

//logout
Route::get('/logout', 'AuthenticationController@getLogout')->before('auth'); 

//dashboard
Route::get('/dashboard', 'DashboardController@getIndex')->before('auth'); 

//todo app
Route::get('/todo', 'TodoController@getIndex')->before('auth'); 				//todo list alleen weergeven voor ingelogde users
Route::post('/todo', 'TodoController@postIndex')->before('csrf'); 				//postIndex ipv '/todo' --> bug? submit (post) naar eigen pagina werkt niet als de app in een subfolder zit

Route::get('/todo/add', 'TodoController@getAddItem')->before('auth'); ;	
Route::post('/todo/add', 'TodoController@postAddItem')->before('csrf');

Route::get('/todo/delete/{id}', array('as' => 'delete', 'uses' => 'TodoController@getDelete'))->before('auth'); //id van item meegeven aan controller, om te k verwijderen
