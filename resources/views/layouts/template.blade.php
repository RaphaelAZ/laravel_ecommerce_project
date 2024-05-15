<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('dist/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('dist/css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body class="relative overflow-x-hidden">
    <div class="sticky top-0 left-0 w-full h-fit z-50">
        @include('layouts.navbar')

        <hr>

        @if(Auth::check() && Auth::user()->role === 'admin')
            @include('layouts.admin.admin-navbar')
        @endif
    </div>


    <div id="app">
        <main class="relative">
            @yield('content')
        </main>
    </div>

    @yield('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
