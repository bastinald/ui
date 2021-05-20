<?php

namespace App\Components\Auth;

use Bastinald\UI\Traits\WithData;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PasswordChange extends Component
{
    use WithData;

    public function render()
    {
        return view('auth.password-change');
    }

    public function rules()
    {
        return [
            'current_password' => 'required|password',
            'password' => 'required|confirmed',
        ];
    }

    public function save()
    {
        $this->validateData();

        Auth::user()->update($this->getData());

        $this->emit('hideModal');
    }
}
