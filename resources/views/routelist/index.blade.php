<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="app">
		<table class="table table-sm table-striped table-dark">
			<thead>
				<tr>
					<th colspan="5"><h2>Route list ({{count($routes)}})</h2></th>
				</tr>
			</thead>
			<thead>
				<tr>
					<th scope="col">Methods</th>
					<th scope="col">Path</th>
					<th scope="col">Name</th>
					<th scope="col">Action</th>
					<th scope="col">Middleware</th>
				</tr>
			</thead>
			<tbody>
				@foreach($routes as $route)
				<tr>
					<td class="text-nowrap">
						@foreach($route->methods() as $method)
						<span class="badge {{$colors[$method]}}">{{$method}}</span> 
						@endforeach
					</td>
					<td>{{$route->uri}}</td>
					<td>{{$route->getName()}}</td>
					<td>{{$route->getActionName()}}</td>
					<td>
						@foreach($route->middleware() as $middleware)
						<span>{{$middleware}}</span> 
						@endforeach
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</body>