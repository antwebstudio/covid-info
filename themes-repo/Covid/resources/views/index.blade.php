@extends('layouts.app')

@php
	$tags = request()->tags ?? '';
	$tags = trim($tags) != '' ? explode(',', $tags) : [];
	$posts = App\Models\Post::withAllTags($tags, '55-tag')->active()->paginate();
@endphp

@section('header.search')
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
@endsection

@section('content')
	@foreach($posts as $post)
		<div class="mb-4">
			<a href="{{ $post->url }}">{{ $post->name }}<br/>{{ $post->name_zh }}</a>
			<div>
				@foreach($post->tags as $tag)
					
					<div class="bg-indigo-100 inline-flex items-center text-sm rounded mt-2 mr-1">
					  <a href="?tags={{ Ant\Core\Helpers\UrlFilter::addTo('tags', $tag->name) }}" class="mx-2 leading-relaxed truncate max-w-xs">
						{{ $tag->getTranslation('name', 'en') }} {{ $tag->getTranslation('name', 'zh') }}
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
@endsection