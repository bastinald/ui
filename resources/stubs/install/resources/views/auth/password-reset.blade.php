@section('title', 'Reset Password')

<x-ui::box col="5">
    <h5>@yield('title')</h5>

    <x-ui::input type="email" label="Email Address" model="email"/>
    <x-ui::input type="password" label="New Password" model="password"/>
    <x-ui::input type="password" label="Confirm New Password" model="password_confirmation"/>

    <x-ui::button action="save" label="Save" block/>
</x-ui::box>
