<?php

namespace Bastinald\UI\Commands;

use Bastinald\UI\Traits\MakesStubs;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Livewire\Commands\ComponentParser;

class ModelCommand extends Command
{
    use MakesStubs;

    protected $signature = 'ui:model {class}';

    public function handle()
    {
        $modelParser = new ComponentParser(
            'App\\Models',
            config('livewire.view_path'),
            $this->argument('class')
        );
        $factoryParser = new ComponentParser(
            'Database\\Factories',
            config('livewire.view_path'),
            $this->argument('class') . 'Factory'
        );

        $replaces = [
            'DummyModelNamespace' => $modelParser->classNamespace(),
            'DummyModelClass' => $modelParser->className(),
            'DummyFactoryNamespace' => $factoryParser->classNamespace(),
            'DummyFactoryClass' => $factoryParser->className(),
        ];

        $this->makeStub(
            $modelParser->classPath(),
            'model.stub',
            $replaces
        );
        $this->makeStub(
            Str::replaceFirst('app/', '', $factoryParser->classPath()),
            'factory.stub',
            $replaces
        );

        $this->info('Model & factory created!');
    }
}
