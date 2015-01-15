@extends ('layouts.master')

@section('title', 'Item toevoegen')

@section('content')
	<h1>Voeg een TODO-item toe</h1>

	<p>{{ HTML::linkAction('TodoController@getIndex', "Terug naar mijn TODO's") }}</p> {{-- bouwt link op naar de getIndex actie van de todocontroller--}}
	
	{{-- array('action' => 'HomeController@postAddItem') --}}
	@foreach($errors->all() as $errorMessage)
		<p class="error"> {{$errorMessage}}</p>
	@endforeach

	{{Form::open()}}
		<label for="inputAddItem">Wat moet er gedaan worden?</label> </br>
		<input type="text" name="inputAddItem" id="inputAddItem"> </br>
		<input type="submit" name="submitAddItem" id="submitAddItem" value="Toevoegen">
	{{Form::close()}}
@stop