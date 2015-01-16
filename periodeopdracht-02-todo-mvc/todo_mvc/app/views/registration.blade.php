@extends ('layouts.master')

@section('title', 'Registratie')

@section('content')
	
	<h1>Registreren</h1>

	{{-- alle validationerrors voor alle invulvelden opvragen uit de $errors MessageBag --}}
	@foreach($errors->all() as $errorMessage)
		<p class="error"> {{$errorMessage}}</p>
	@endforeach
	
	{{Form::open()}}

	<label for="email">e-mail:</label><br/>
	<input type="text" name="email" id="email"><br/>
	<label for="password">paswoord:</label><br/>
	<input type="password" name="password" id="password"><br/>
	<input type="submit" name="submitRegistreren" id="submitRegistreren" value="Registreer">
	
	{{Form::close()}}
@stop