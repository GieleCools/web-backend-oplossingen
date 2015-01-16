<?php

class TodoController extends BaseController 
{
	public function getIndex()
	{
		//Auth::check() niet meer nodig, want er w enkel naar homepagina gegaan als user ingelogd is (dmv route-filter)
		// if (Auth::check())
		// {
		//      $items = Auth::user()->items;
		// }

		//items van ingelogde user opvragen en in $items steken
		$itemsTodo = Auth::user()->items()->where('done','=', 0)->get();
		$itemsDone = Auth::user()->items()->where('done','=', 1)->get();

		//view aanmaken, en data (items) meegeven
		return View::make('todo', array('itemsTodo' => $itemsTodo, 'itemsDone' => $itemsDone));
	}
	
	public function postIndex()
	{
		//value opvragen van de button met name="toggleTodo"
		$id = Input::get('toggleStatus');

		//user_id van de ingelogde user opvragen
		$user_id = Auth::user()->id;
		
		//findOrFail methode (is overgeerfde methode van Eloquent) van de Item klasse oproepen
		$item = Item::findOrFail($id);

		//status alleen instellen als het item van de ingelogde user is
		if ($item->user_id == $user_id) 
		{
			$item->toggleStatus();
		}

		//redirect naar todo overzicht
		return Redirect::to('/todo');
	}

	public function getAddItem()
	{
		return View::make('addItem');
	}

	public function postAddItem()
	{
		$input = array('inputAddItem' => Input::get('inputAddItem'));
		$validationRules = array('inputAddItem' => 'required|min:1|max:255'); //naam van todo item is verplicht en mag niet meer karakters bevatten dan database toelaat
		$messages = array('inputAddItem.required' => 'Hmm, iets vergeten in te vullen?'); //custom error message, enkel voor de required rule van inputAddItem inputveld

		$validator = Validator::make($input, $validationRules, $messages);

		$userId = Auth::user()->id; //userId hebben we nodig om de ingevoegde taak te kunnen koppelen in de db met de ingelogde user

		if ($validator->fails()) 
		{
			return Redirect::route('add')->withErrors($validator);														
		}

		$item = new Item;
		$item->name = Input::get('inputAddItem');
		$item->user_id = $userId;
		$item->save();

		return Redirect::to('/todo');
	}

	public function getDelete($id)
	{
		$resultItem = Item::find($id);

		//user_id van de ingelogde user opvragen
		$user_id = Auth::user()->id;

		//als er een item bij het id gevonden wordt, en het item bij de ingelogde user hoort, dan verwijderen
		if ($resultItem && $resultItem->user_id == $user_id) 
		{	
			$resultItem->delete();
			return Redirect::to('/todo');
		}
	}
}
