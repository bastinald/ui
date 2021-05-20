<?php

namespace App\Components\Auth;

use Bastinald\UI\Traits\WithData;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class PasswordForgot extends Component
{
    use WithData;

    public $status;

    public function route()
    {
        return Route::get('password-forgot', static::class)
            ->name('password.forgot')
            ->middleware('guest');
    }

    public function render()
    {
        return view('auth.password-forgot');
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
        ];
    }

    public function send()
    {
        $this->validateData();

        $status = Password::sendResetLink($this->getData(['email']));

        if ($status == Password::RESET_LINK_SENT) {
            $this->status = __($status);
        } else {
            $this->addError('email', __($status));
        }
    }
}
