<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/jpg" href="{{ url('images/logo.jpg') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Prenly') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    

    <!-- styles -->
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
</head>

<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="{{ route('index') }}">Prenly</a></h1>
						<nav class="links">
							<ul>
								<li><a href="{{ route('home') }}">Home</a></li>
							</ul>
						</nav>
						<nav class="main">
							<ul>
                                @auth
                                    <li class="username">
                                        <a href="#">
                                            <h3>{{ Auth::user()->name }}</h3>
                                            <p>Welcome! </p>
                                        </a>
                                    </li>
                                @endauth
								<li class="menu">
									<a class="fa-bars" href="#menu">Menu</a>
								</li>
							</ul>
						</nav>
					</header>

				<!-- Menu -->
					<section id="menu">

						<!-- Links -->
							<section>
								<ul class="links">
									<li>
										<a href="#">
											<h3>Home</h3>
											<!-- <p>Feugiat tempus veroeros dolor</p> -->
										</a>
									</li>
								</ul>
							</section>

						<!-- Actions -->
							<section>
								<ul class="actions stacked">
                                    @guest
                                        @if (Route::has('login'))
                                            <li>
                                                <a class="button large fit" href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
                                        @endif

                                        @if (Route::has('register'))
                                            <li>
                                                <a class="button large fit" href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <li>
                                            <div>
                                                <a class="button large fit" href="{{ route('logout') }}">{{ __('Logout') }}</a>
                                                <!-- <a class="button large fit" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a> -->

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    @endguest
								</ul>
							</section>

					</section>

				<!-- Main Content -->
                @yield('content')

                <!-- Sidebar -->
                @yield('sidebar')
                
			</div>
            
            <div id="spinner">
                <img src="{{ url('images/ajax-spinner.gif') }}"/>
            </div>

		<!-- Scripts -->
			<script src="{{ url('js/jquery.min.js') }}"></script>
			<script src="{{ url('js/browser.min.js') }}"></script>
			<script src="{{ url('js/breakpoints.min.js') }}"></script>
			<script src="{{ url('js/util.js') }}"></script>
			<script src="{{ url('js/main.js') }}"></script>
            <script src="{{ url('js/newsScript.js') }}"></script>

	</body>
</html>