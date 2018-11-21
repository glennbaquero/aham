@extends('master')

@section('content')

	<h1>{{ config('app.name') }}</h1>
	<a href="{{ route('admin.dashboard') }}">Dashboard</a>
	<a href="{{ route('admin.login.show') }}">Login</a>

@endsection