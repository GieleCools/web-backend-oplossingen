<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
		return View::make('home');
	}

	// public function postIndex()
	// {
	// 	// //value opvragen van de button met name="toggleTodo"
	// 	// $id = Input::get('toggleStatus');

	// 	// //user_id van de ingelogde user opvragen
	// 	// $user_id = Auth::user()->id;
		
	// 	// //findOrFail methode (is overgeerfde methode van Eloquent) van de Item klasse oproepen
	// 	// $item = Item::findOrFail($id);

	// 	// //status alleen instellen als het item van de ingelogde user is
	// 	// if ($item->user_id == $user_id) 
	// 	// {
	// 	// 	$item->toggleStatus();
	// 	// }

	// 	//redirect naar homepage
	// 	//return Redirect::to('/');
	// }

}
