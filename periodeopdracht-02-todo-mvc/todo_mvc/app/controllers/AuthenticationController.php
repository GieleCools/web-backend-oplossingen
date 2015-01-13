<?php
	class AuthenticationController extends Controller
	{

		//login methode voor de http-get login request --> loginformulier weergeven
		public function getLogin()
		{
			return View::make('login');
		}

		//login methode voor de http-post login request, wanneer er op de submitknop 'inloggen' gedrukt w
		public function postLogin()
		{
			//validation rules toevoegen, zodat er geen leeg inlogformulier gesubmit kan worden
			$validationRules = array(	'email' => 'required|email', 	
										'password' => 'required|min:8'); //email is verplicht, en moet volgens emailformaat //paswd is verplicht, en minimum 8karakters lang

			//The first argument passed to the make method is the data under validation. The second argument is the validation rules that should be applied to the data.
			$validator = Validator::make(Input::all(), $validationRules);

			if ($validator->fails()) 
			{
				return Redirect::to('login')->withErrors($validator); //terug naar get van login gaan, naar loginform, en de errors van de validator meegeven 
																		//withErrors: This method will flash the error messages to the session so that they are available on the next request.
			}
		}
	}
?>