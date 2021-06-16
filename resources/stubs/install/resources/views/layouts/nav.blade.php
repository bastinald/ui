<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand">{{ config('app.name') }}</a>

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

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <button type="button" class="dropdown-item"
                                    wire:click="$emit('showModal', 'auth.profile-update')">
                                {{ __('Update Profile') }}
                            </button>

                            <button type="button" class="dropdown-item"
                                    wire:click="$emit('showModal', 'auth.password-change')">
                                {{ __('Change Password') }}
                            </button>

                            <button type="button" class="dropdown-item" wire:click="logout">
                                {{ __('Logout') }}
                            </button>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>
