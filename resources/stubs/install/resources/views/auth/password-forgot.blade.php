@section('title', __('Forgot Password'))

<div class="d-grid col-lg-5 mx-auto">
    <form class="card" wire:submit.prevent="send">
        <h5 class="card-header">
            @yield('title')
        </h5>
        <div class="card-body pb-0">
            @if($status)
                <div class="alert alert-success">{{ $status }}</div>
            @endif

            <x-ui::input :label="__('Email')" type="email" model="email"/>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">{{ __('Send Password Reset Link') }}</button>
        </div>
    </form>
</div>
