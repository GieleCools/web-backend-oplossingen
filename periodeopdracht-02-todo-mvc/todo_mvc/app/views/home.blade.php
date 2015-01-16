@extends ('layouts.master')

{{-- 'Home' instellen als title van pagina --}}
@section('title', 'Home')

@section('content')	

	<h1>Welkom bij mijn Todo App!</h1>

	<p>Als je je nog niet registreert hebt, doe het dan even vooraleer je je takenlijstje kan ingeven. </p>
	{{ HTML::linkAction('AuthenticationController@getRegistration', "Registreer") }}
@stop