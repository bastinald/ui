<?php

namespace DummyComponentNamespace;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

class DummyComponentClass extends Component
{
    public function route()
    {
        return Route::get('/DummyRouteUri', static::class)
            ->name('DummyRouteName');
    }

    public function render()
    {
        return view('DummyViewName');
    }
}
