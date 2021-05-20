<?php

namespace App\Components\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Bastinald\UI\Traits\WithData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Lukeraymonddowning\Honey\Traits\WithHoney;
use Lukeraymonddowning\Honey\Traits\WithRecaptcha;

class Register extends Component
{
    use WithData, WithHoney, WithRecaptcha;

    public function route()
    {
        return Route::get('register', static::class)
            ->name('register')
            ->middleware('guest');
    }

    public function render()
    {
        return view('auth.register');
    }

    public function rules()
    {
        return [
            'name' => 'required|alpha_dash|min:2|max:20|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ];
    }

    public function register()
    {
        $this->validateData();

        if ($this->honeyPasses()) {
            $user = User::create($this->getData());

            Auth::login($user);

            return redirect()->to(RouteServiceProvider::HOME);
        }
    }
}
