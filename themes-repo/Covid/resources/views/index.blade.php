@extends('layouts.app')

@php
	$tags = request()->tags ?? '';
	$tags = trim($tags) != '' ? explode(',', $tags) : [];
	$posts = App\Models\Post::withAllTags($tags, '55-tag')->active()->paginate();
@endphp

@section('content')
	<header class="w-full">
		<nav x-data="{ navOpen: false }" class="flex items-center justify-between flex-wrap bg-teal-500 p-6">
		  <div class="flex flex-nowrap items-center justify-between w-full flex-shrink-0 text-white">
			<h1 class="font-semibold sm:text-xl tracking-tight">{{ config('app.name') }}</h1>
			
			  <div class="block lg:hidden">
				<button @click="navOpen = !navOpen" class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
				  <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
				</button>
			  </div>
		  </div>
		  <div :class=" navOpen ? '' : 'hidden' " class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
			<div class="text-sm lg:flex-grow">
			  <a href="{{ url('disclaimer') }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
				Disclaimer
			  </a>
			  <a href="{{ url('contribute') }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
				Contribute
			  </a>
			</div>
			{{--
			<div>
			  <a href="#" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Download</a>
			</div>
			--}}
		  </div>
		</nav>
		<div class="container mx-auto py-3">
					  <div data-tags='@json($tags)'>
						  <div x-data="tagSelect()" @tags-update="tagUpdated($event.detail.tags)" x-init="init('parentEl')" @click.away="clearSearch()" @keydown.escape="clearSearch()">
							<div class="relative" @keydown.enter.prevent="addTag(textInput)">
							  <input x-model="textInput" x-ref="textInput" @input="search($event.target.value)" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter some tags">
							  <div :class="[open ? 'block' : 'hidden']">
								<div class="absolute z-40 left-0 mt-2 w-full">
								  <div class="py-1 text-sm bg-white rounded shadow-lg border border-gray-300">
									<a @click.prevent="addTag(textInput)" class="block py-1 px-5 cursor-pointer hover:bg-indigo-600 hover:text-white">Add tag "<span class="font-semibold" x-text="textInput"></span>"</a>
								  </div>
								</div>
							  </div>
							  <!-- selections -->
							  <template x-for="(tag, index) in tags">
								<div class="bg-indigo-100 inline-flex items-center text-sm rounded mt-2 mr-1">
								  <span class="ml-2 mr-1 leading-relaxed truncate max-w-xs" x-text="tag"></span>
								  <button @click.prevent="removeTag(index)" class="w-6 h-8 inline-block align-middle text-gray-500 hover:text-gray-600 focus:outline-none">
									<svg class="w-6 h-6 fill-current mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M15.78 14.36a1 1 0 0 1-1.42 1.42l-2.82-2.83-2.83 2.83a1 1 0 1 1-1.42-1.42l2.83-2.82L7.3 8.7a1 1 0 0 1 1.42-1.42l2.83 2.83 2.82-2.83a1 1 0 0 1 1.42 1.42l-2.83 2.83 2.83 2.82z"/></svg>
								  </button>
								</div>
							  </template>
							</div>
						  </div>
						</div>
		</div>
	</header>
	
	<div class="container mx-auto py-3">
	
		@foreach($posts as $post)
			<div class="mb-4">
				<a href="{{ $post->url }}">{{ $post->name }}</a>
				<div>
					@foreach($post->tags as $tag)
						
						<div class="bg-indigo-100 inline-flex items-center text-sm rounded mt-2 mr-1">
						  <a href="?tags={{ Ant\Core\Helpers\UrlFilter::addTo('tags', $tag->name) }}" class="mx-2 leading-relaxed truncate max-w-xs">
							{{ $tag->name }}
						  </a>
						</div>
					@endforeach
				</div>
			</div>
		@endforeach
		
		{{--
		<pre>{{ print_r($tags,1) }}</pre>
		<pre>{{ print_r($posts->toArray(),1) }}</pre>
		--}}
	</div>
@endsection