<?php

namespace App\Components\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Bastinald\UI\Traits\WithData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class PasswordReset extends Component
{
    use WithData;

    public function route()
    {
        return Route::get('password-reset/{token}/{email}', static::class)
            ->name('password.reset')
            ->middleware('guest');
    }

    public function mount($token, $email)
    {
        $this->setData('token', $token);
        $this->setData('email', $email);
    }

    public function render()
    {
        return view('auth.password-reset');
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ];
    }

    public function save()
    {
        $this->validateData();

        $status = Password::reset($this->getData(), function (User $user) {
            $user->update($this->getData());

            Auth::login($user);
        });

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->to(RouteServiceProvider::HOME);
        } else {
            $this->addError('email', __($status));
        }
    }
}
