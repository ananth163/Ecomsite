@extends('admin.layout.base')

@section('title', 'Dashboard')

@section('content')

	<h1>Dashboard</h1>
	{!! App\Classes\CSRFHandler::getToken() !!}
	<br>
	
	{!! $_SESSION['token'] !!}
	@if(App\Classes\CSRFHandler::validateToken('abc'))
	<h1>Validation success</h1>
	@else
	<h1>Validation Failed</h1>
	@endif
	
	<form action="/admin" method="POST">
		<input type="text" name="name" placeholder="Enter Name">
		<button type="submit" name="submit">Submit</button>
	</form>


@endsection