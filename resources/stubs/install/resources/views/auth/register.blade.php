@section('title', __('Register'))

<div class="d-grid col-lg-5 mx-auto">
    <form class="card" wire:submit.prevent="register">
        <h5 class="card-header">
            @yield('title')
        </h5>
        <div class="card-body pb-0">
            <x-ui::input :label="__('Name')" type="text" model="name"/>
            <x-ui::input :label="__('Email')" type="email" model="email"/>
            <x-ui::input :label="__('Password')" type="password" model="password"/>
            <x-ui::input :label="__('Confirm Password')" type="password" model="password_confirmation"/>

            <x-honey/>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
        </div>
    </form>
</div>
