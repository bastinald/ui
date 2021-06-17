<?php

namespace DummyComponentNamespace;

use DummyModelNamespace\DummyModelClass;
use Livewire\Component;

class Read extends Component
{
    public $DummyModelVariable;

    public function mount(DummyModelClass $DummyModelVariable = null)
    {
        $this->DummyModelVariable = $DummyModelVariable;
    }

    public function render()
    {
        return view('DummyViewName.read');
    }
}
