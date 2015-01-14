<html>
	<head>
		<title>@yield('title') | Oplossing opdracht 02 Todo MVC - Giele Cools</title> <!-- paginatitel w per view ingesteld, en hier ingevuld -->
		<link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
	</head>
	<body>
		<div id="todoAppBackground"></div>

		<div id="todoApp">
			@yield('content')
		</div>
		
	</body>
</html>