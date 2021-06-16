@section('title', __('Reset Password'))

<div class="d-grid col-lg-5 mx-auto">
    <form class="card" wire:submit.prevent="resetPassword">
        <h5 class="card-header">
            @yield('title')
        </h5>
        <div class="card-body pb-0">
            <x-ui::input :label="__('Email')" type="email" model="email"/>
            <x-ui::input :label="__('New Password')" type="password" model="password"/>
            <x-ui::input :label="__('New Confirm Password')" type="password" model="password_confirmation"/>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">{{ __('Reset Password') }}</button>
        </div>
    </form>
</div>
