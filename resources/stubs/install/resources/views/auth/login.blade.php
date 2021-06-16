@section('title', __('Login'))

<div class="d-grid col-lg-5 mx-auto">
    <form class="card" wire:submit.prevent="login">
        <h5 class="card-header">
            @yield('title')
        </h5>
        <div class="card-body pb-0">
            <x-ui::input :label="__('Email')" type="email" model="email"/>
            <x-ui::input :label="__('Password')" type="password" model="password"/>

            <div class="d-flex justify-content-between">
                <x-ui::checkbox :label="__('Remember me')" model="remember"/>

                @if(Route::has('password.forgot'))
                    <a href="{{ route('password.forgot') }}">{{ __('Forgot password?') }}</a>
                @endif
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
        </div>
    </form>
</div>
