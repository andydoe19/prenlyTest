<div id="news">
	<!-- Mini Posts -->
	@foreach($news as $selectedNews)

		<!-- Mini Post -->
		<article class="mini-post hidden">
			<a href="javascript:gotoNewsDetatail();" class="image articleImage">
				<img src="{{$selectedNews['urlToImage']}}" alt="" />
			</a>
			<header>
				<h3 class="articleTitle">
					<a class="articleTitle" href="javascript:void(0);">{{$selectedNews['title']}}</a>
				</h3>
				<time class="published">
					@if($selectedNews['publishedAt'] !== null)
						{{ Carbon\Carbon::parse($selectedNews['publishedAt'])->format('l jS \\of F Y ') }}
					@else
						{{ __('Unknown')}}
					@endif
				</time>
				<a href="#" class="author"><img src="images/avatar.jpg" alt="" /></a>
			</header>
			<input type="hidden" class="articleAuthor" value="{{$selectedNews['author']}}">
			<input type="hidden" class="articleDesc" value="{{$selectedNews['description']}}">
			<input type="hidden" class="articleUrl" value="{{$selectedNews['url']}}">
			<input type="hidden" class="articleContent" value="{{$selectedNews['content']}}">
			<input type="hidden" class="articlePublishedAt" value="{{$selectedNews['publishedAt']}}">
			<input type="hidden" class="articleSourceId" value="{{$sourceId}}">
			<input type="hidden" class="articleSourceName" value="{{$sourceName}}">
		</article>

	@endforeach
</div>

<ul id="highlights">
	@foreach ($highlights as $highlightSingle)
		<li class="hidden">
			<article class="highlight">
				<header>
					<h3 class="articleTitle"><a href="javascript:void(0)">{{ $highlightSingle['title'] }}</a></h3>
					<time class="published">
						@if($highlightSingle['publishedAt'] !== null)
							{{ Carbon\Carbon::parse($highlightSingle['publishedAt'])->format('l jS \\of F Y ') }}
						@else
							{{ __('Unknown')}}
						@endif
					</time>
				</header>
				<a href="javascript:void(0);" class="image articleImage">
					<img src="{{$highlightSingle['urlToImage']}}" alt="" />
				</a>
				
				<input type="hidden" class="articleAuthor" value="{{$selectedNews['author']}}">
				<input type="hidden" class="articleDesc" value="{{$selectedNews['description']}}">
				<input type="hidden" class="articleUrl" value="{{$selectedNews['url']}}">
				<input type="hidden" class="articleContent" value="{{$selectedNews['content']}}">
				<input type="hidden" class="articlePublishedAt" value="{{$selectedNews['publishedAt']}}">
				<input type="hidden" class="articleSourceId" value="{{$sourceId}}">
				<input type="hidden" class="articleSourceName" value="{{$sourceName}}">
			</article>
		</li>
	@endforeach
</ul>