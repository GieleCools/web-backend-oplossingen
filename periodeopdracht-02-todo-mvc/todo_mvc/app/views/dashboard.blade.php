@extends ('layouts.master')

@section('title', 'Dashboard')

@section('content')	

	<h1>Dashboard</h1>

	<p>Klik op onderstaande link om de Todo App te openen. </p>
	{{ HTML::linkAction('TodoController@getIndex', "Todo App") }}
@stop