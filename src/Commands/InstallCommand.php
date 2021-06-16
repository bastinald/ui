<?php

namespace Bastinald\Ui\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

class InstallCommand extends Command
{
    public $filesystem;

    protected $signature = 'ui:install';

    public function handle()
    {
        $this->filesystem = new Filesystem;
        $this->filesystem->copyDirectory(__DIR__ . '/../../resources/stubs/install', base_path());

        $this->deleteUserMigration();
        $this->runCommands();

        $this->info('UI installed! ' . config('app.url'));
    }

    public function deleteUserMigration()
    {
        $userMigration = database_path('migrations/2014_10_12_000000_create_users_table.php');

        if ($this->filesystem->exists($userMigration)) {
            $this->filesystem->delete($userMigration);
        }
    }

    public function runCommands()
    {
        exec('npm install');
        exec('npm run dev');

        Artisan::call('ide-helper:generate', [], $this->getOutput());
        Artisan::call('ui:migrate -fs', [], $this->getOutput());
    }
}
