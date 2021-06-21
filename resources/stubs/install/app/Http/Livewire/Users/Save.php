<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Bastinald\Ui\Traits\WithModel;
use Livewire\Component;

class Save extends Component
{
    use WithModel;

    public $user;

    public function mount(User $user = null)
    {
        $this->user = $user;

        $this->setModel($user->toArray());
    }

    public function render()
    {
        return view('users.save');
    }

    public function save()
    {
        $this->validateModel($this->user->rules());

        $this->user->fill($this->getModel(['name', 'email', 'password']))->save();

        $this->emit('hideModal');
        $this->emit('$refresh');
    }
}
