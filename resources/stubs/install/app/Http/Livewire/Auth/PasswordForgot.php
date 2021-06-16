<?php

namespace App\Http\Livewire\Auth;

use Bastinald\Ui\Traits\WithModel;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class PasswordForgot extends Component
{
    use WithModel;

    public $status;

    public function route()
    {
        return Route::get('/password-forgot', static::class)
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
            'email' => ['required', 'email'],
        ];
    }

    public function send()
    {
        $this->validateModel();

        $status = Password::sendResetLink($this->getModel(['email']));

        if ($status != Password::RESET_LINK_SENT) {
            $this->reset('status');
            $this->addError('email', __($status));

            return;
        }

        $this->status = __($status);
    }
}
