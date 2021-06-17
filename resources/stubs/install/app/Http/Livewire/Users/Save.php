<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Bastinald\Ui\Traits\WithModel;
use Illuminate\Validation\Rule;
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

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user->id)],
            'password' => [!$this->user->exists ? 'required' : 'nullable', 'confirmed'],
        ];
    }

    public function save()
    {
        $this->validateModel();

        $this->user->fill($this->getModel(['name', 'email', 'password']))->save();

        $this->emit('hideModal');
        $this->emit('$refresh');
    }
}
