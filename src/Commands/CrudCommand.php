<?php

namespace Bastinald\Ui\Commands;

use Bastinald\Ui\Traits\MakesStubs;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Livewire\Commands\ComponentParser;

class CrudCommand extends Command
{
    use MakesStubs;

    public $componentParser, $modelParser;

    protected $signature = 'ui:crud {class} {--force}';

    public function handle()
    {
        $this->setParsers();

        if (file_exists($this->componentParser->classPath()) && !$this->option('force')) {
            $this->warn('CRUD already exists, use the <info>--force</info> to overwrite it!');

            return;
        }

        $this->setStubReplaces();
        $this->makeStubs();
        $this->makeModel();

        $this->info('CRUD components & views made!');
    }

    public function setParsers()
    {
        $this->componentParser = new ComponentParser(
            config('livewire.class_namespace'),
            config('livewire.view_path'),
            Str::plural($this->argument('class')) . '\\Index',
        );

        $this->modelParser = new ComponentParser(
            'App\\Models',
            config('livewire.view_path'),
            Str::singular(Arr::last(explode('\\', $this->componentParser->classNamespace()))),
        );
    }

    public function setStubReplaces()
    {
        $title = preg_replace('/(.)(?=[A-Z])/u', '$1 ', $this->modelParser->className());
        $titles = Str::plural($title);
        $viewName = Str::replaceLast('.index', '', $this->componentParser->viewName());

        $this->stubReplaces = [
            'DummyComponentNamespace' => $this->componentParser->classNamespace(),
            'DummyModelNamespace' => $this->modelParser->classNamespace(),
            'DummyModelClass' => $this->modelParser->className(),
            'DummyModelVariables' => Str::camel($titles),
            'DummyModelVariable' => Str::camel($title),
            'DummyRouteUri' => Str::replace('.', '/', $viewName),
            'DummyRouteName' => $viewName,
            'DummyViewName' => $viewName,
            'DummyViewTitles' => $titles,
            'DummyViewTitle' => $title,
        ];
    }

    public function makeStubs()
    {
        $componentPath = Str::replaceLast('/Index.php', '', $this->componentParser->classPath());
        $viewPath = Str::replaceLast('/index.blade.php', '', $this->componentParser->viewPath());
        $stubNames = ['index', 'read', 'save'];

        foreach ($stubNames as $stubName) {
            $this->makeStub(
                $componentPath . '/' . Str::ucfirst($stubName) . '.php',
                '/crud/' . Str::ucfirst($stubName) . '.php'
            );

            $this->makeStub(
                $viewPath . '/' . $stubName . '.blade.php',
                '/crud/' . $stubName . '.blade.php'
            );
        }
    }

    public function makeModel()
    {
        $modelClass = $this->modelParser->className();

        if (!file_exists($this->modelParser->classPath()) &&
            $this->confirm('Model <comment>' . $modelClass . '</comment> does not exist, make it now?')) {
            Artisan::call('ui:model ' . $modelClass, [], $this->getOutput());

            $this->warn("Don't forget to migrate after updating the model or CRUD will throw errors.");
        }
    }
}
