<?php

namespace App\Components\Auth;

use App\Providers\RouteServiceProvider;
use Bastinald\UI\Traits\WithData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Livewire\Component;

class Login extends Component
{
    use WithData;

    public function route()
    {
        return Route::get('login', static::class)
            ->name('login')
            ->middleware('guest');
    }

    public function render()
    {
        return view('auth.login');
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function login()
    {
        $this->validateData();

        if ($this->ensureIsNotRateLimited() && $this->authenticate()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    public function ensureIsNotRateLimited()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return true;
        }

        $this->addError('email', __('auth.throttle', [
            'seconds' => RateLimiter::availableIn($this->throttleKey()),
        ]));

        return false;
    }

    public function authenticate()
    {
        if (Auth::attempt($this->getData(['email', 'password']), $this->getData('remember'))) {
            RateLimiter::clear($this->throttleKey());

            return true;
        }

        RateLimiter::hit($this->throttleKey());

        $this->addError('email', __('auth.failed'));

        return false;
    }

    public function throttleKey()
    {
        return Str::lower($this->getData('email')) . '|' . request()->ip();
    }
}
