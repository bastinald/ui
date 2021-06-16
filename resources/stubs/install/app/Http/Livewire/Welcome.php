<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Welcome extends Component
{
    public function route()
    {
        return Route::get('/', static::class);
    }

    public function render()
    {
        return view('welcome');
    }
}
