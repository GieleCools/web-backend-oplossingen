@extends ('layouts.master')

@section('content')
	{{-- Inlogformulier aanmaken in de view --}}

	{{Form::open()}}

	<label for="email">e-mail:</label><br/>
	<input type="text" name="email" id="email"><br/>
	<label for="email">paswoord:</label><br/>
	<input type="password" name="password" id="password"><br/>
	<input type="submit" name="inloggen" id="inloggen" value="inloggen">
	
	{{Form::close()}}
@stop