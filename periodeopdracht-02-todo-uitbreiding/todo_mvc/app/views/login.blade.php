@extends ('layouts.master')

{{-- 'Login' instellen als title van pagina --}}
@section('title', 'Login')

@section('content')

	@if (Session::get('logoutSuccessMessage') != null)
		<p class="success"> {{Session::get('logoutSuccessMessage')}}</p>
	@endif

	<h1>Inloggen</h1>
	
	{{-- alle validationerrors voor alle invulvelden opvragen uit de $errors MessageBag --}}
	@foreach($errors->all() as $errorMessage)
		<p class="error"> {{$errorMessage}}</p>
	@endforeach
	
	{{-- Inlogformulier aanmaken in de view --}}
	{{Form::open()}}

	<label for="email">e-mail:</label>
	<input type="text" name="email" id="email">
	<label for="password">paswoord:</label>
	<input type="password" name="password" id="password">
	<input type="submit" name="inloggen" id="inloggen" value="Inloggen">
	
	{{Form::close()}}
@stop