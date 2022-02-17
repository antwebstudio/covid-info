@extends('layouts.html')

@section('title'){{ config('app.name') }}@endsection

@section('layout')
	@yield('content')
@endsection