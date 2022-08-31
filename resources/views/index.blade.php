@extends('layouts.app')

@section('content')
				<!-- Main -->
					<div id="main" class="mini">

                        <div class="tools">
                            <div class="row">
                                <div class="col-6">
                                    {{ csrf_field() }}
                                    <select name="newsSource" id="selNewsSource">
                                        <option value="">- Select News Source -</option>
                                        @foreach ($newsSources as $newsSource)
                                            <option value="{{$newsSource['id']}} : {{$newsSource['name'] }}" @if($sourceId == $newsSource['id']) selected @endif>
                                                {{$newsSource['name']}}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                                <div class="col-6">
                                    <div id="spinnerSmall" class="hidden">
                                        <img src="{{ url('images/loading.gif') }}" width="25" height="25" style="margin:10px">
                                        <span>...Loading</span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- ######################################### -->
                        <!-- All News Articles for selected news source -->
                        <!-- ######################################### -->
                        <div id="articles">

                            <div class="mini-posts-content">

                                <!-- Mini Posts -->
                                @foreach($news as $selectedNews)

                                    <!-- Mini Post -->
                                    <article class="mini-post">
                                        <a href="javascript:void(0);" class="image articleImage">
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
                                        <input type="hidden" class="articleUrl" value="{{htmlspecialchars($selectedNews['url'])}}">
                                        <input type="hidden" class="articleContent" value="{{$selectedNews['content']}}">
                                        <input type="hidden" class="articlePublishedAt" value="{{$selectedNews['publishedAt']}}">
                                        <input type="hidden" class="articleSourceId" value="{{$sourceId}}">
                                        <input type="hidden" class="articleSourceName" value="{{$sourceName}}">
                                    </article>
                                @endforeach

                            </div>

                            <!-- For submitting selected News article -->
                            <form id="article-form" action="{{ route('articleDetail') }}" method="POST" class="d-none">
                                @csrf
                            </form>

						    <!-- Pagination -->
							<div class="pagination">
                                <input type="hidden" id="pageNumber" name="pageNumber" value="1">
								<button class="button load-more">Load More</button>
                            </div>
                        
                        </div> 
					</div>
@endsection

@section('sidebar')
				<!-- Sidebar -->
					<section id="sidebar">

                            <!-- About -->
							<section id="intro" class="blurb">
								<div>
                                    <div style="display:inline-block; vertical-align:middle">
                                        <a href="#" class="logo"><img src="images/logo.jpg" alt="" /></a>
                                    </div>
                                    <div style="display:inline-block; vertical-align:middle; padding:0 15px">
                                        <h2>About Prenly Feed</h2>
                                    </div>
                                </div>
								<p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem.</p>
								<ul class="actions">
									<li><a href="#" class="button">Learn More</a></li>
								</ul>
							</section>

							<section id="intro" style="">
								<header>
									<h2>Headlines</h2>
								</header>
							</section>


						    <!-- ######################################### -->
                            <!-- All News Highlights for selected source -->
                            <!-- ######################################### -->
							<section>
								<ul class="posts news-highlights">

                                    @foreach ($highlights as $highlightSingle)
                                        <li>
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
                                                <input type="hidden" class="articleUrl" value="{{htmlspecialchars($selectedNews['url'])}}">
                                                <input type="hidden" class="articleContent" value="{{$selectedNews['content']}}">
                                                <input type="hidden" class="articlePublishedAt" value="{{$selectedNews['publishedAt']}}">
                                                <input type="hidden" class="articleSourceId" value="{{$sourceId}}">
                                                <input type="hidden" class="articleSourceName" value="{{$sourceName}}">
                                            </article>
                                        </li>
                                    @endforeach
								</ul>
							</section>

						    <!-- Footer -->
							<section id="footer">
								<ul class="icons">
									<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
									<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
									<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
									<li><a href="#" class="icon solid fa-rss"><span class="label">RSS</span></a></li>
									<li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
								</ul>
								<p class="copyright">&copy; Prenly 2022</p>
							</section>

					</section>
@endsection