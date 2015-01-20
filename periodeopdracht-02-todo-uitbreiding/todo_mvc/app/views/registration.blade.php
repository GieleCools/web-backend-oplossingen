@extends ('layouts.master')

@section('title', 'Registratie')

@section('content')
	
	<h1>Registreren</h1>

	{{-- alle validationerrors voor alle invulvelden opvragen uit de $errors MessageBag --}}
	@foreach($errors->all() as $errorMessage)
		<p class="error"> {{$errorMessage}}</p>
	@endforeach
	
	{{Form::open()}}

	<label for="email">e-mail:</label>
	<input type="text" name="email" id="email">
	<label for="password">paswoord:</label>
	<input type="password" name="password" id="password">
	<input type="submit" name="submitRegistreren" id="submitRegistreren" value="Registreer">
	
	{{Form::close()}}
	
@stop