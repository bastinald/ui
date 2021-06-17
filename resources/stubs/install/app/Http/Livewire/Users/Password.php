<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Bastinald\Ui\Traits\WithModel;
use Livewire\Component;

class Password extends Component
{
    use WithModel;

    public $user;

    public function mount(User $user = null)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('users.password');
    }

    public function rules()
    {
        return [
            'password' => ['required', 'confirmed'],
        ];
    }

    public function save()
    {
        $this->validateModel();

        $this->user->update($this->getModel(['password']));

        $this->emit('hideModal');
    }
}
