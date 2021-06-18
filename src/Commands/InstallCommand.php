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

        $this->determineIconVersion();
        $this->deleteUserMigration();
        $this->runCommands();

        $this->info('UI installed! ' . config('app.url'));
    }

    public function determineIconVersion()
    {
        $version = $this->choice(
            'Which version of Font Awesome?',
            ['Free', 'Pro (requires global NPM token config)']
        );

        if ($version != 'Free') {
            Artisan::call('vendor:publish --tag=ui:config');

            $files = [base_path('package.json'), config_path('ui.php'), resource_path('scss/app.scss')];

            foreach ($files as $file) {
                $contents = str_replace(
                    ['@fortawesome/fontawesome-free', "'UI_FONT_AWESOME_STYLE', 'solid'"],
                    ['@fortawesome/fontawesome-pro', "'UI_FONT_AWESOME_STYLE', 'regular'"],
                    $this->filesystem->get($file)
                );

                $this->filesystem->put($file, $contents);
            }
        }
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

        Artisan::call('ide-helper:generate');
        Artisan::call('ui:migrate -fs');
    }
}
