@section('title', __('Home'))

<div class="d-grid col-lg-5 mx-auto">
    <div class="card">
        <h5 class="card-header">
            @yield('title')
        </h5>
        <div class="card-body">
            {{ __('You are logged in!') }}
        </div>
    </div>
</div>
