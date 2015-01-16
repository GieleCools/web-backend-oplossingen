@extends ('layouts.master')

{{-- 'Home' instellen als title van pagina --}}
@section('title', 'Home')

@section('content')	

	<h1>Welkom bij mijn Todo App!</h1>

	<p>Registreer je even, zodat je snel je takenlijstje kan ingeven. </p>
	{{ HTML::linkAction('AuthenticationController@getRegistration', "Registreer") }}
@stop