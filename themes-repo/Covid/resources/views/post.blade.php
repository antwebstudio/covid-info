@extends('layouts.app')

@php
	$post = App\Models\Post::find($page->id);
@endphp

@section('content')
	<div class="container mx-auto py-3">
	
		<div>
			<a href="{{ $post->url }}">{{ $post->name }}</a>
		</div>
		
		<a href="{{ url('/') }}" class="btn btn-primary my-2">Back</a>
	</div>
@endsection