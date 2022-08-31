@extends('layouts.app')

@section('content')
				<!-- Main -->
					<div id="main">

                        <!-- ################# -->
                        <!-- notification panel -->
                        <!-- ################# -->
                        @if ($message != "" )
                            <div class="col-12">
                                <div class="alert success">
                                    <input type="checkbox" id="alert2"/>
                                    <label class="close" title="close" for="alert2"> x </label>
                                    <p class="inner">
                                        {{ $message }}
                                    </p>
                                </div>
                            </div>
                        @endif
                        

                        <!-- ################# -->
                        <!-- Back arrow -->
                        <!-- ################# -->
                        <div class="row direction-nav">
                            <div class="col-4">
                                <a href="{{ route('index') }}" class="button fit"> 
                                    <span>&larr;</span> Back
                                </a>
                            </div>
                        </div>

						<!-- Post -->
							<article class="post">

                                @if ( isset($singleNewsDetail) )
                                    <header>
                                        <div class="title">
                                            <h2><a href="#">{{$singleNewsDetail['title']}}</a></h2>
                                            <!-- <p>Lorem ipsum dolor amet nullam consequat etiam feugiat</p> -->
                                        </div>
                                        <div class="meta">
                                            <time class="published" datetime="2015-11-01">
                                                @if($singleNewsDetail['publishedAt'] !== null)
                                                    {{ Carbon\Carbon::parse($singleNewsDetail['publishedAt'])->format('l jS \\of F Y ') }}
                                                @else
                                                    {{ __('Unknown')}}
                                                @endif
                                            </time>
                                            <a href="#" class="author">
                                                <span class="name">Jane Doe</span>
                                                <img src="images/avatar.jpg" alt="" />
                                            </a>
                                        </div>
                                    </header>
                                    <span class="image featured"><img src="{{$singleNewsDetail['imageUrl']}}" alt="" /></span>
                                    <div class="decoded-article-content">{{ $singleNewsDetail['content'] }}</div>
                                    <footer>
                                        <ul class="stats">
                                            <li>Visit Source : <a target="_blank" href="{{$singleNewsDetail['url']}}">{{$singleNewsDetail['sourceName']}}</a></li>
                                            <li><a href="#" class="icon solid fa-comment">{{ count($messages) }}</a></li>
                                        </ul>
                                    </footer>

                                    <div class="custombox clearfix">
                                        <h4 class="small-title">{{ count($messages) }} Comment(s)</h4>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                @if ( count($messages) > 0 )
                                                    <div class="comments-list">
                                                        @foreach ($messages as $key => $message)
                                                            <div class="media @if( $key+1 == count($messages) ) last-child @endif">
                                                                <img src="{{ url('images/user_profile3.jpg') }}" alt="website template image" class="rounded-circle">
                                                                <div class="media-body">
                                                                    <h4 class="media-heading user_name">{{ $message->user->name }}</h4>
                                                                    <p>{{ $message->comment }}</p>
                                                                    <h4><small>Commented on {{ date('jS M Y', strtotime($message->created_at)) }}</small></h4>
                                                                    <!-- <h4><small>5 days ago</small></h4> -->
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span>No comments posted yet.</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="custombox clearfix">
                                        <h4 class="small-title">Post a Comment</h4>
                                            <div class="col-lg-12">
                                                @auth
                                                <form method="POST" action="{{ route('articleDetail') }}">
                                                    @csrf
                                                    <div class="gtr-uniform">
                                                        <div class="col-lg-12">
                                                            <textarea name="comment" id="articleComment" placeholder="Enter your comment" rows="6" column="10"></textarea>
                                                            @error('articleMessage')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-lg-12" style="margin-top:20px;">
                                                            <input type="hidden" name="image" value="{{$singleNewsDetail['imageUrl']}}">
                                                            <input type="hidden" name="title" value="{{$singleNewsDetail['title']}}">
                                                            <input type="hidden" name="author" value="{{$singleNewsDetail['author']}}">
                                                            <input type="hidden" name="desc" value="{{$singleNewsDetail['description']}}">
                                                            <input type="hidden" name="url" value="{{$singleNewsDetail['url']}}">
                                                            <input type="hidden" name="content" value="{{$singleNewsDetail['content']}}">
                                                            <input type="hidden" name="publishedAt" value="{{$singleNewsDetail['publishedAt']}}">
                                                            <input type="hidden" name="sourceId" value="{{$singleNewsDetail['sourceId']}}">
                                                            <input type="hidden" name="sourceName" value="{{$singleNewsDetail['sourceName']}}">
                                                            <input type="hidden" name="saveComment" value="YES">
                                                            
                                                            <input type="submit" value="Send Message" />
                                                        </div>
                                                    </div>
                                                </form>
                                                @else
                                                    <a class="button large fit" href="{{ route('login') }}">Login to Comment</a>
                                                @endauth
                                            </div>
                                    </div>
                                @else
                                    <p>Invalid Data provided. <a href="{{ route('index') }}">Go Back Home</a></p>
                                @endif

							</article>

					</div>
@endsection

