<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="{{ asset('images/logo.png') }}?v={{ config('app.version') }}"
                alt="{{ config('app.name') }}" height="24">
        </a>

        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="nav" class="collapse navbar-collapse">
            <div class="navbar-nav ms-auto">
                @guest
                    @if(Route::has('login'))
                        <a href="{{ route('login') }}" class="nav-link">{{ __('Login') }}</a>
                    @endif

                    @if(Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-link">{{ __('Register') }}</a>
                    @endif
                @else
                    <a href="{{ url('/home') }}" class="nav-link">{{ __('Home') }}</a>

                    @if(Route::has('users'))
                        <a href="{{ route('users') }}" class="nav-link">{{ __('Users') }}</a>
                    @endif

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <x-ui::icon name="user-circle"/> {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <x-ui::dropdown-item :label="__('Update Profile')"
                                click="$emit('showModal', 'auth.profile-update')"/>

                            <x-ui::dropdown-item :label="__('Change Password')"
                                click="$emit('showModal', 'auth.password-change')"/>

                            <x-ui::dropdown-item :label="__('Logout')" click="logout"/>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>
