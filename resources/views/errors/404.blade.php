@extends('layouts.app')

@section('content')
	<div
	  class="
		flex
		items-center
		justify-center
		w-full
		h-full
	  "
	>
	  <div class="px-40 py-20 bg-white rounded-md ">
		<div class="flex flex-col items-center">
		  <h1 class="font-bold text-teal-600 text-9xl">404</h1>

		  <h6 class="mb-2 text-2xl font-bold text-center text-gray-800 md:text-3xl">
			<span class="text-red-500">Oops!</span> Page not found
		  </h6>

		  <p class="mb-8 text-center text-gray-500 md:text-lg">
			The page you’re looking for doesn’t exist.
		  </p>

		  <a
			href="{{ url('/') }}"
			class="px-6 py-2 text-sm font-semibold text-teal-800 bg-teal-100"
			>Go home 返回首页</a
		  >
		</div>
	  </div>
	</div>
@endsection	