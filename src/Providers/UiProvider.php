<?php

namespace Bastinald\Ui\Providers;

use Bastinald\Ui\Commands\ComponentCommand;
use Bastinald\Ui\Commands\CrudCommand;
use Bastinald\Ui\Commands\InstallCommand;
use Bastinald\Ui\Commands\MigrateCommand;
use Bastinald\Ui\Commands\ModelCommand;
use Bastinald\Ui\Components\ModalComponent;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class UiProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ComponentCommand::class,
                CrudCommand::class,
                InstallCommand::class,
                MigrateCommand::class,
                ModelCommand::class,
            ]);
        }

        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'ui');

        $this->publishes([
            __DIR__ . '/../../config/ui.php' => config_path('ui.php'),
        ], ['ui', 'ui:config']);

        $this->publishes([
            __DIR__ . '/../../resources/stubs/crud' => resource_path('stubs/vendor/ui/crud'),
            __DIR__ . '/../../resources/stubs/make' => resource_path('stubs/vendor/ui/make'),
        ], ['ui', 'ui:stubs']);

        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/ui'),
        ], ['ui', 'ui:views']);

        Livewire::component('modal', ModalComponent::class);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/ui.php', 'ui');
    }
}
