<?php

namespace Bastinald\Ui\Components;

use Livewire\Component;

class ModalComponent extends Component
{
    public $component;
    public $params = [];

    protected $listeners = ['showModal', 'resetModal'];

    public function render()
    {
        return view('ui::components.modal');
    }

    public function showModal($component, ...$params)
    {
        $this->component = $component;
        $this->params = $params;

        $this->emit('showBootstrapModal');
    }

    public function resetModal()
    {
        $this->reset();
    }
}
