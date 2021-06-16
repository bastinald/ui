<?php

namespace App\Http\Livewire\Layouts;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Nav extends Component
{
    protected $listeners = ['$refresh'];

    public function render()
    {
        return view('layouts.nav');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->to('/');
    }
}
