<?php

namespace Bastinald\Ui\Commands;

use Illuminate\Console\Command;
use Doctrine\DBAL\Schema\Comparator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

class MigrateCommand extends Command
{
    protected $signature = 'ui:migrate {--f|--fresh} {--s|--seed} {--force}';

    public function handle()
    {
        if (app()->environment('production') && !$this->option('force')) {
            $this->warn('You must use the <info>--force</info> to migrate in production!');

            return;
        }

        $this->runTraditionalMigrations();
        $this->runAutomaticMigrations();

        if ($this->option('seed')) {
            $this->seed();
        }
    }

    public function runTraditionalMigrations()
    {
        $command = 'migrate';

        if ($this->option('fresh')) {
            $command .= ':fresh';
        }

        if ($this->option('force')) {
            $command .= ' --force';
        }

        Artisan::call($command);
    }

    public function runAutomaticMigrations()
    {
        $path = app_path('Models');
        $namespace = app()->getNamespace();

        foreach ((new Finder)->in($path) as $model) {
            $model = $namespace . str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    Str::after($model->getRealPath(), realpath(app_path()) . DIRECTORY_SEPARATOR)
                );

            if (method_exists($model, 'migration')) {
                $this->migrate($model);
            }
        }

        $this->info('Migration complete!');
    }

    public function migrate($model)
    {
        $model = app($model);
        $modelTable = $model->getTable();

        if (Schema::hasTable($modelTable)) {
            $tempTable = 'temp_' . $modelTable;

            Schema::dropIfExists($tempTable);
            Schema::create($tempTable, function (Blueprint $table) use ($model) {
                $model->migration($table);
            });

            $schemaManager = $model->getConnection()->getDoctrineSchemaManager();
            $modelTableDetails = $schemaManager->listTableDetails($modelTable);
            $tempTableDetails = $schemaManager->listTableDetails($tempTable);
            $tableDiff = (new Comparator)->diffTable($modelTableDetails, $tempTableDetails);

            if ($tableDiff) {
                $schemaManager->alterTable($tableDiff);
            }

            Schema::drop($tempTable);
        } else {
            Schema::create($modelTable, function (Blueprint $table) use ($model) {
                $model->migration($table);
            });
        }
    }

    public function seed()
    {
        $command = 'db:seed';

        if ($this->option('force')) {
            $command .= ' --force';
        }

        Artisan::call($command);

        $this->info('Seeding complete!');
    }
}
