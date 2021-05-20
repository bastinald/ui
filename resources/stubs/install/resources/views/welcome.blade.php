@section('title', 'Welcome')

<x-ui::box col="5">
    <h5>@yield('title')</h5>

    <p class="mb-0">Welcome to {{ config('app.name') }}!</p>
</x-ui::box>
