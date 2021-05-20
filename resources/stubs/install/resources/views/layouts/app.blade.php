<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @hasSection('title') @yield('title') | @endif
        {{ config('app.name') }}
    </title>

    <livewire:styles/>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ config('app.version') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/icon-touch.png') }}?v={{ config('app.version') }}">
    <link rel="icon" href="{{ asset('images/icon-fav.png') }}?v={{ config('app.version') }}">
    <link rel="manifest" href="{{ asset('json/manifest.json') }}?v={{ config('app.version') }}">
</head>
<body class="bg-light">
    <livewire:layouts.nav/>

    <main class="container my-3">
        {{ $slot }}
    </main>

    <livewire:scripts/>
    <livewire:modal/>
    <script src="{{ asset('js/app.js') }}?v={{ config('app.version') }}"></script>
</body>
</html>
