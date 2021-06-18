<?php

namespace Bastinald\Ui\Commands;

use Bastinald\Ui\Traits\MakesStubs;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Livewire\Commands\ComponentParser;

class ComponentCommand extends Command
{
    use MakesStubs;

    public $componentParser;

    protected $signature = 'ui:component {class} {--f|--full} {--m|--modal} {--force}';

    public function handle()
    {
        $this->setParser();

        if (file_exists($this->componentParser->classPath()) && !$this->option('force')) {
            $this->warn('Component already exists, use the <info>--force</info> to overwrite it!');

            return;
        }

        $this->setStubReplaces();
        $this->makeStubs();

        $this->info('Component & view made!');
    }

    public function setParser()
    {
        $this->componentParser = new ComponentParser(
            config('livewire.class_namespace'),
            config('livewire.view_path'),
            $this->argument('class')
        );
    }

    public function setStubReplaces()
    {
        $this->stubReplaces = [
            'DummyComponentNamespace' => $this->componentParser->classNamespace(),
            'DummyComponentClass' => $this->componentParser->className(),
            'DummyRouteUri' => Str::replace('.', '/', $this->componentParser->viewName()),
            'DummyRouteName' => $this->componentParser->viewName(),
            'DummyViewName' => $this->componentParser->viewName(),
            'DummyViewTitle' => preg_replace('/(.)(?=[A-Z])/u', '$1 ', $this->componentParser->className()),
            'DummyWisdomOfTheTao' => $this->componentParser->wisdomOfTheTao(),
        ];
    }

    public function makeStubs()
    {
        if ($this->option('full')) {
            $type = 'Full';
        } else if ($this->option('modal')) {
            $type = 'Modal';
        } else {
            $type = 'Partial';
        }

        $this->makeStub(
            $this->componentParser->classPath(),
            '/make/DummyComponent' . $type . 'Class.php'
        );

        $this->makeStub(
            $this->componentParser->viewPath(),
            '/make/DummyComponent' . $type . '.blade.php'
        );
    }
}
