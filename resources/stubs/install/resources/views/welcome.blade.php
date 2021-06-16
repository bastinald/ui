@section('title', __('Welcome'))

<div class="d-grid col-lg-5 mx-auto">
    <div class="card">
        <h5 class="card-header">
            @yield('title')
        </h5>
        <div class="card-body">
            {{ __('Welcome to the app!') }}
        </div>
    </div>
</div>
