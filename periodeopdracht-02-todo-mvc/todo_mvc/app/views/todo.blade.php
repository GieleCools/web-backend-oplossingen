@extends ('layouts.master')

@section('title', 'Todo App')

@section('content')

	@if (Session::get('successMessage') != null)
		<p class="success"> {{Session::get('successMessage')}}</p>
	@endif

	<h1>De TODO app</h1>

	@if ($itemsTodo->count() == 0  && $itemsDone->count() == 0 )
		<p>Je hebt nog geen TODO's toegevoegd. {{ HTML::linkAction('TodoController@getAddItem', "Voeg item toe") }}</p>
	@else
	
		<h2>Wat moet er allemaal gebeuren?</h2>
		
		@foreach($errors->all() as $errorMessage)
			<p class="error"> {{$errorMessage}}</p>
		@endforeach

		<p>{{ HTML::linkAction('TodoController@getAddItem', "Voeg item toe") }}</p>

		{{-- De data overlopen die meegegeven is ad view ($items) --}}

		<h3>Todo</h3>
		@if($itemsTodo->count() > 0)
			<ul class="items">
				@foreach($itemsTodo as $item)
						<li>
							{{-- specifieke action meegeven, want submit naar eigen pagina werkt niet in subfolder, zie routes.php --}}
							{{Form::open(array('action' => 'TodoController@postIndex'))}}
								<button name="toggleStatus" value="{{$item->id}}" class="status todo">{{e($item->name)}}</button> {{-- e() gaat input escapen, zo is sql injectie niet mogelijk --}}	
							{{Form::close()}}

							{{Form::open(array('action' => array('TodoController@getDelete', $item->id), 'method' => 'get'))}} {{-- routeparameter ($item->id) w meegegeven --}}
								<button name="deleteTodo" value="{{$item->id}}"></button>
							{{Form::close()}}
						</li>
				@endforeach
			</ul>
		@else
			<p>Schouderklopje, alles is gedaan!</p>
		@endif

		<h3>Done</h3>
		@if($itemsDone->count() > 0)
			<ul class="items">
				@foreach($itemsDone as $item)
						<li>
							{{Form::open(array('action' => 'TodoController@postIndex'))}}
								<button name="toggleStatus" value="{{$item->id}}" class="status done">{{e($item->name)}}</button>
							{{Form::close()}}

							{{Form::open(array('action' => array('TodoController@getDelete', $item->id), 'method' => 'get'))}} {{-- routeparameter ($item->id) w meegegeven --}}
								<button name="deleteTodo" value="{{$item->id}}"></button>
							{{Form::close()}}
						</li>
				@endforeach
			</ul>
		@else
			<p>Werk aan de winkel...</p>
		@endif
	@endif
	
@stop