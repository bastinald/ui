<?php

namespace Bastinald\UI\Commands;

use Bastinald\UI\Traits\MakesStubs;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Livewire\Commands\ComponentParser;

class ComponentCommand extends Command
{
    use MakesStubs;

    protected $signature = 'ui:component {class} {--f}';

    public function handle()
    {
        $componentParser = new ComponentParser(
            config('livewire.class_namespace'),
            config('livewire.view_path'),
            $this->argument('class')
        );

        $replaces = [
            'DummyComponentNamespace' => $componentParser->classNamespace(),
            'DummyComponentClass' => $componentParser->className(),
            'DummyViewPath' => Str::replace('.', '/', $componentParser->viewName()),
            'DummyViewName' => $componentParser->viewName(),
            'DummyViewTitle' => preg_replace('/(.)(?=[A-Z])/u', '$1 ', $componentParser->className()),
            'DummyViewWisdom' => $componentParser->wisdomOfTheTao(),
        ];

        $this->makeStub(
            $componentParser->classPath(),
            'component-' . ($this->option('f') ? 'full' : 'partial') . '.stub',
            $replaces
        );
        $this->makeStub(
            $componentParser->viewPath(),
            'view-' . ($this->option('f') ? 'full' : 'partial') . '.stub',
            $replaces
        );

        $this->info('Component & view created!');
    }
}
