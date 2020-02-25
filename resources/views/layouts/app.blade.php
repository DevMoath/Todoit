<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="description" content="{{ config('app.description', 'Todoit') }}">
        <!-- Google / Search Engine Tags -->
        <meta itemprop="name" content="{{ config('app.name', 'Todoit') }}">
        <meta itemprop="description" content="{{ config('app.description', 'Todoit') }}">
        <meta itemprop="image" content="{{ asset('img/icon-256.png') }}">
        <!-- Facebook Meta Tags -->
        <meta property="og:url" content="{{ config('app.url', 'Todoit') }}">
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ config('app.name', 'Todoit') }}">
        <meta property="og:description" content="{{ config('app.description', 'Todoit') }}">
        <meta property="og:image" content="{{ asset('img/icon-256.png') }}">
        <!-- Twitter Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:creator" content="@dev_moath">
        <meta name="twitter:title" content="{{ config('app.name', 'Todoit') }}">
        <meta name="twitter:description" content="{{ config('app.description', 'Todoit') }}">
        <meta name="twitter:image" content="{{ asset('img/icon-256.png') }}">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Todoit') }} @yield('title')</title>
        <link rel="icon" href="{{ asset('img/icon-256.png') }}">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div>
            @yield('content')
        </div>
        @yield('js')
    </body>
</html>
