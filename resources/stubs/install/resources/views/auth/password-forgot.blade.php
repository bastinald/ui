@section('title', 'Forgot Password')

<x-ui::box col="5">
    <h5>@yield('title')</h5>

    @if($status)
        <p class="text-success mb-0">{{ $status }}</p>
    @else
        <x-ui::input type="email" label="Email Address" model="email"/>

        <x-ui::button action="send" label="Send Password Reset Link" block/>
    @endif
</x-ui::box>
