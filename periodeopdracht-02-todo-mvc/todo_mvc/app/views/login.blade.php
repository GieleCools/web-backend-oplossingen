@extends ('layouts.master')

@section('content')

	{{-- alle validationerrors voor alle invulvelden opvragen uit de $errors MessageBag --}}
	@foreach($errors->all() as $errorMessage)
		<p class="error"> {{$errorMessage}}</p>
	@endforeach
	
	{{-- Inlogformulier aanmaken in de view --}}
	{{Form::open()}}

	<label for="email">e-mail:</label><br/>
	<input type="text" name="email" id="email"><br/>
	<label for="email">paswoord:</label><br/>
	<input type="password" name="password" id="password"><br/>
	<input type="submit" name="inloggen" id="inloggen" value="inloggen">
	
	{{Form::close()}}
@stop