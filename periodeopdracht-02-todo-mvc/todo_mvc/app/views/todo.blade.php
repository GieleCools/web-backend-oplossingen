@extends ('layouts.master')

{{-- 'Home' instellen als title van pagina --}}
@section('title', 'Todo App')

@section('content')

	<h1>De TODO app</h1>
	<h2>Wat moet er allemaal gebeuren?</h2>

	<p>{{ HTML::linkAction('TodoController@getAddItem', "Voeg item toe") }}</p>

	{{-- De data overlopen die meegegeven is ad view ($items) --}}

	<h3>Todo</h3>

	@foreach($errors->all() as $errorMessage)
		<p class="error"> {{$errorMessage}}</p>
	@endforeach

	<ul class="items">
		@foreach($items as $item)
			@if(!$item->done)
				<li>
					{{-- specifieke action meegeven, want submit naar eigen pagina werkt niet in subfolder, zie routes.php --}}
					{{Form::open(array('action' => 'TodoController@postIndex'))}}
						<button name="toggleStatus" value="{{$item->id}}" class="status todo">{{e($item->name)}}</button> {{-- e() gaat input escapen, zo is sql injectie niet mogelijk --}}
						
					{{Form::close()}}

					{{Form::open(array('action' => array('TodoController@getDelete', $item->id), 'method' => 'get'))}} {{-- routeparameter ($item->id) w meegegeven --}}
						<button name="deleteTodo" value="{{$item->id}}"></button>
					{{Form::close()}}

				</li>
			@endif
		@endforeach
	</ul>

	<h3>Done</h3>
	<ul class="items">
		@foreach($items as $item)
			@if($item->done)
				<li>
					{{Form::open(array('action' => 'TodoController@postIndex'))}}
						<button name="toggleStatus" value="{{$item->id}}" class="status done">{{e($item->name)}}</button>
					{{Form::close()}}

					{{Form::open(array('action' => array('TodoController@getDelete', $item->id), 'method' => 'get'))}} {{-- routeparameter ($item->id) w meegegeven --}}
						<button name="deleteTodo" value="{{$item->id}}"></button>
					{{Form::close()}}

				</li>
			@endif
		@endforeach
	</ul>
	

@stop