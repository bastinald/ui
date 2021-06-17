<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <livewire:styles/>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>
    <livewire:layouts.nav/>

    <div class="container my-3">
        {{ $slot }}
    </div>

    <livewire:modal/>

    <livewire:scripts/>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
