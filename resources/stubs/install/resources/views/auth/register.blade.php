@section('title', 'Register')

<x-ui::box col="5">
    <h5>@yield('title')</h5>

    <x-ui::input type="text" label="Username" data="name"/>
    <x-ui::input type="email" label="Email Address" data="email"/>
    <x-ui::input type="password" label="Password" data="password"/>
    <x-ui::input type="password" label="Confirm Password" data="password_confirmation"/>

    <x-honey recaptcha/>

    <x-ui::button action="register" label="Register" block/>

    <div class="d-flex flex-column align-items-center small mt-3">
        <x-ui::link :href="route('login')" label="Login to account"/>
    </div>
</x-ui::box>
