<?php

namespace App\Components\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Logout extends Component
{
    public function route()
    {
        return Route::get('logout', static::class)
            ->name('logout')
            ->middleware('auth');
    }

    public function mount()
    {
        Auth::logout();

        return redirect()->to('/');
    }
}
