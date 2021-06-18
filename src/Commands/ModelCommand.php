<?php

namespace Bastinald\Ui\Commands;

use Bastinald\Ui\Traits\MakesStubs;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Livewire\Commands\ComponentParser;

class ModelCommand extends Command
{
    use MakesStubs;

    public $modelParser;
    public $factoryParser;

    protected $signature = 'ui:model {class} {--force}';

    public function handle()
    {
        $this->setParsers();

        if (file_exists($this->modelParser->classPath()) && !$this->option('force')) {
            $this->warn('Model already exists, use the <info>--force</info> to overwrite it!');

            return;
        }

        $this->setStubReplaces();
        $this->makeStubs();

        $this->info('Model & factory made!');
    }

    public function setParsers()
    {
        $this->modelParser = new ComponentParser(
            'App\\Models',
            config('livewire.view_path'),
            $this->argument('class')
        );

        $this->factoryParser = new ComponentParser(
            'Database\\Factories',
            config('livewire.view_path'),
            $this->argument('class') . 'Factory'
        );
    }

    public function setStubReplaces()
    {
        $this->stubReplaces = [
            'DummyModelNamespace' => $this->modelParser->classNamespace(),
            'DummyModelClass' => $this->modelParser->className(),
            'DummyFactoryNamespace' => $this->factoryParser->classNamespace(),
            'DummyFactoryClass' => $this->factoryParser->className(),
        ];
    }

    public function makeStubs()
    {
        $this->makeStub(
            $this->modelParser->classPath(),
            '/make/DummyModelClass.php'
        );

        $this->makeStub(
            Str::replaceFirst('app/', '', $this->factoryParser->classPath()),
            '/make/DummyFactoryClass.php'
        );
    }
}
