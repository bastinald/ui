<?php

namespace Bastinald\Ui\Providers;

use Bastinald\Ui\Commands\ComponentCommand;
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
                InstallCommand::class,
                MigrateCommand::class,
                ModelCommand::class,
            ]);
        }

        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'ui');

        Livewire::component('modal', ModalComponent::class);
    }
}
