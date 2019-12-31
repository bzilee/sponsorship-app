<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Rafraichissement automatique -->
    {{-- <meta http-equiv="refresh" content="5"> --}}

    <title>
        @if (isset($title))
            {{  $title }}
        @else
            {{ config('app.name', 'Laravel') }}
        @endif

    </title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Barre de titre de chrome -->
    <meta name="theme-color" content="#845124">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/app.profile.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/app.showprofile.css') }}" rel="stylesheet">
    @if (isset($css_page))
    <link href="{{ asset('css/'.$css_page) }}" rel="stylesheet">
    @endif
    @if (isset($css_page2))
    <link href="{{ asset('css/'.$css_page2) }}" rel="stylesheet">
    @endif
    @if (isset($less_css_page))
    <link href="{{ asset('css/'.$less_css_page) }}" rel="stylesheet">
    @endif
    <link href="{{ asset('lib/WOW/css/animate.css') }}" rel="stylesheet">



    <link rel="stylesheet" href="{{asset('vendor/laraberg/css/laraberg.css')}}">
    <script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
    <script src="https://unpkg.com/react@16.6.3/umd/react.production.min.js"></script>

    <script src="https://unpkg.com/react-dom@16.6.3/umd/react-dom.production.min.js"></script>

    <script src="https://unpkg.com/moment@2.22.1/min/moment.min.js"></script>

    {{-- <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script> --}}
</head>
<body >
<div class="bg-gradient" id="bg-gradient"></div>
    <div id="app" >
        <nav class="navbar navbar-expand-md navbar-light shadow-sm nav-bar-custum">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo/SponsorshipAPP.png') }}" alt="Logo App" height="30px">
                </a>
                <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto ">
                        <li class="nav-item nav-link countdown">
                            @if (!isset($count_down_nav))
                            <countdown date="{{ $count_down_date }}" url="{{ route('sponsorship.start') }}"></countdown>
                            @endif
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Inscription') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('user.profile') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('profile-form').submit();">
                                        {{ __('Mon profil') }}
                                    </a>
                                    <form id="profile-form" action="{{ route('user.profile') }}" method="GET" style="display: none;">

                                    </form>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Déconnexion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')

        </main>

    </div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('lib/WOW/js/wow.min.js') }}" defer></script>
@if (isset($js_page))
<script src="{{ asset('js/'.$js_page) }}" defer></script>
@endif
@if (isset($js_page2))
<script src="{{ asset('js/'.$js_page2) }}" defer></script>
@endif
</body>
</html>
