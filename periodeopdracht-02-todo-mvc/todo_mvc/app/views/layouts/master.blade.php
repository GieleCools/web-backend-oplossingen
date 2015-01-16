<html>
	<head>
		<title>@yield('title') | Oplossing opdracht 02 Todo MVC - Giele Cools</title> <!-- paginatitel w per view ingesteld, en hier ingevuld -->
		<link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
	</head>
	<body>

		<div id="todoAppBackground"></div>
	
	<header>
		<ul class="nav">
			<!-- Bepalen welke navigatielinks getoond mogen worden voor user die ingelogd is, of voor guest-->
			@if(Auth::check())
				<li class="">{{ HTML::linkAction('HomeController@getIndex', "Home") }}</li>
				<li class="">{{ HTML::linkAction('DashboardController@getIndex', "Dashboard") }}</li>
				<li class="">{{ HTML::linkAction('TodoController@getIndex', "Todo") }}</li>
				<li class="">{{ HTML::linkAction('AuthenticationController@getLogout', "Log uit (" . Auth::user()->email . ")" ) }}</li>
			@else
				<li class="">{{ HTML::linkAction('HomeController@getIndex', "Home") }}</li>
				<li class="">{{ HTML::linkAction('AuthenticationController@getLogin', "Login") }}</li>
				<li class="">{{ HTML::linkAction('AuthenticationController@getRegistration', "Registreer") }}</li>
			@endif
		</ul>
	</header>

		<div id="todoApp">
			@yield('content')
		</div>
		
	</body>
</html>