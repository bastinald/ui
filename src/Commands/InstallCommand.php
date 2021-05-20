<?php

namespace Bastinald\UI\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

class InstallCommand extends Command
{
    protected $signature = 'ui:install';

    public function handle()
    {
        $filesystem = new Filesystem;

        $filesystem->copyDirectory(__DIR__ . '/../../resources/stubs/install', base_path());

        if ($filesystem->exists($userMigration = database_path('migrations/2014_10_12_000000_create_users_table.php'))) {
            $filesystem->delete($userMigration);
        }

        Artisan::call('ui:migrate --fs');

        exec('npm install');
        exec('npm run dev');

        $this->info('UI installed!');
    }
}
