@section('title', 'Login')

<x-ui::box col="5">
    <h5>@yield('title')</h5>

    <x-ui::input type="email" label="Email Address" model="email"/>
    <x-ui::input type="password" label="Password" model="password"/>
    <x-ui::check label="Remember me" model="remember"/>

    <x-ui::button action="login" label="Login" block/>

    <div class="d-flex flex-column align-items-center small mt-3">
        <x-ui::link :href="route('register')" label="Register an account"/>
        <x-ui::link :href="route('password.forgot')" label="Forgot password"/>
    </div>
</x-ui::box>
