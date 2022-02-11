@extends('layouts.app')

@php
	$post = App\Models\Post::find($page->id);
	
    $autolink = new OsiemSiedem\Autolink\Autolink(app('osiemsiedem.autolink.parser'), app('app.autolink.renderer'));
@endphp

@section('title', $post->name)

@section('content')
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v13.0&appId=205407196610271&autoLogAppEvents=1" nonce="XZq9jrtP"></script>
	
	<div class="container mx-auto py-3 px-3">
	
		<h1>{{ $post->name }}</h1>
		<article class="article">
			{!! $autolink->convert($post->content) !!}
		</article>
		
		<a href="{{ url('/?tags='.request()->tags) }}" class="btn btn-primary my-2">Back</a>
		
		@if(isset($post->collecting) && $post->collecting->isNotEmpty())
		<div class="mt-3 mb-5">
			<h2>征求网民提供资讯：</h2>
			<ul class="list-disc">
				@foreach($post->collecting as $message)
					<li class="pl-3 ml-5">{{ $message }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		
		@if(isset($post->additional) && $post->additional->isNotEmpty())
		<div class="mt-3 mb-5">
			<h2>其他参考资讯 Other related references：</h2>
			<ul class="list-disc">
				@foreach($post->additional as $message)
					<li class="pl-3 ml-5"><a href="{{ $message }}" target="_blank">{{ $message }}</a></li>
				@endforeach
			</ul>
		</div>
		@endif
		
		<div id="disqus_thread"></div>
		<script>
			/**
			*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
			*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
			
			var disqus_config = function () {
			this.page.url = "{{ url()->current() }}";  // Replace PAGE_URL with your page's canonical URL variable
			this.page.identifier = "p_{{ $post->id }}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
			};
			
			(function() { // DON'T EDIT BELOW THIS LINE
			var d = document, s = d.createElement('script');
			s.src = 'https://covid-info.disqus.com/embed.js';
			s.setAttribute('data-timestamp', +new Date());
			(d.head || d.body).appendChild(s);
			})();
		</script>
		<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
		
		
	</div>
@endsection
