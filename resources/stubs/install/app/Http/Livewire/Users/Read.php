<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Read extends Component
{
    public $user;

    public function mount(User $user = null)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('users.read');
    }
}
