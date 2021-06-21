<?php

namespace DummyComponentNamespace;

use DummyModelNamespace\DummyModelClass;
use Bastinald\Ui\Traits\WithModel;
use Livewire\Component;

class Save extends Component
{
    use WithModel;

    public $DummyModelVariable;

    public function mount(DummyModelClass $DummyModelVariable = null)
    {
        $this->DummyModelVariable = $DummyModelVariable;

        $this->setModel($DummyModelVariable->toArray());
    }

    public function render()
    {
        return view('DummyViewName.save');
    }

    public function save()
    {
        $this->validateModel($this->DummyModelVariable->rules());

        $this->DummyModelVariable->fill($this->getModel())->save();

        $this->emit('hideModal');
        $this->emit('$refresh');
    }
}
