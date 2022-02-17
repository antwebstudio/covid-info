@extends('layouts.html')

@section('title'){{ config('app.name') }}@endsection

@section('layout')
	
	<header class="w-full">
		<nav x-data="{ navOpen: false }" class="flex items-center justify-between flex-wrap bg-teal-500 p-6">
		  <div class="flex flex-nowrap items-center justify-between w-full flex-shrink-0 text-white">
			<h1 class="font-semibold sm:text-xl tracking-tight"><a href="{{ url('/') }}">{{ config('app.name') }}</a></h1>
			
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
		
		@yield('header.search')
	</header>
	
	<div class="container mx-auto py-3">
		@yield('content')
	</div>
@endsection