@extends('layouts.blank')

@php
    $autolink = new OsiemSiedem\Autolink\Autolink(app('osiemsiedem.autolink.parser'), app('app.autolink.renderer'));
@endphp

@section('title', $page->name)

@section('content')
	<div class="container mx-auto py-3 px-3">
	
		<h1>{{ $page->name }}</h1>
		<article>
			{!! $autolink->convert($page->content) !!}
		</article>
		
		<a href="{{ url('/?tags='.request()->tags) }}" class="btn btn-primary my-2">Back</a>
		
		<div id="disqus_thread"></div>
		<script>
			/**
			*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
			*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
			
			var disqus_config = function () {
			this.page.url = "{{ url()->current() }}";  // Replace PAGE_URL with your page's canonical URL variable
			this.page.identifier = "page_{{ $page->slug }}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
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