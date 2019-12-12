<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Rafraichissement automatique -->
    {{-- <meta http-equiv="refresh" content="5"> --}}

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Barre de titre de chrome -->
    <meta name="theme-color" content="#845124">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.profile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.showprofile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.404error.css') }}" rel="stylesheet">
    @if (isset($css_page))
    <link href="{{ asset('css/'.$css_page) }}" rel="stylesheet">
    @endif


</head>
<body >
<div class="bg-gradient"></div>
    <div id="app" >
        <main class="py-4">
            @yield('content')

        </main>

    </div>

</body>
</html>
