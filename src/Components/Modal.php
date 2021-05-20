<?php

namespace Bastinald\UI\Components;

use Livewire\Component;

class Modal extends Component
{
    public $component;
    public $data = [];

    protected $listeners = ['showModal', 'resetModal'];

    public function showModal($component, ...$data)
    {
        $this->component = $component;
        $this->data = $data;

        $this->emit('showBootstrapModal');
    }

    public function resetModal()
    {
        $this->reset();
    }

    public function render()
    {
        return view('ui::components.modal');
    }
}
