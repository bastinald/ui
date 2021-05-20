<nav class="navbar navbar-expand navbar-light sticky-top bg-white shadow-sm">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="{{ asset('images/logo.png') }}?v={{ config('app.version') }}" alt="{{ config('app.name') }}">
        </a>

        <div id="nav" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                @guest
                    <x-ui::nav-item :href="route('login')" icon="sign-in-alt"/>
                    <x-ui::nav-item :href="route('register')" icon="user-plus"/>
                @else
                    <x-ui::nav-item :href="url('home')" icon="home"/>
                    <x-ui::nav-dropdown icon="user">
                        <x-ui::dropdown-item action="$emit('showModal', 'auth.profile-edit')" label="Edit Profile"/>
                        <x-ui::dropdown-item action="$emit('showModal', 'auth.password-change')" label="Change Password"/>
                        <x-ui::dropdown-item :href="route('logout')" label="Logout"/>
                    </x-ui::nav-dropdown>
                @endguest
            </ul>
        </div>
    </div>
</nav>
