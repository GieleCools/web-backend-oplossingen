@extends ('layouts.master')

{{-- 'Home' instellen als title van pagina --}}
@section('title', 'Home')

@section('content')	

	<h1>Welkom bij mijn Todo App!</h1>
	
	<p>Deze todo app is een opdracht voor Web Backend. Veel plezier ermee!</p>
	{{-- Enkel weergeven als user niet ingelogd is --}}
	@if(!Auth::check())
		<p>Als je je nog niet registreert hebt, doe het dan even vooraleer je je takenlijstje kan ingeven. </p>
		{{ HTML::linkAction('AuthenticationController@getRegistration', "Registreer") }} of {{ HTML::linkAction('AuthenticationController@getLogin', "Log in") }} 
	@endif
	
@stop