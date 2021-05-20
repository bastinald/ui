<?php

namespace Bastinald\UI\Commands;

use Illuminate\Console\Command;
use Doctrine\DBAL\Schema\Comparator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

class MigrateCommand extends Command
{
    protected $signature = 'ui:migrate {--f} {--s} {--fs}';

    public function handle()
    {
        $this->handleTraditionalMigrations();
        $this->handleAutomaticMigrations();

        if ($this->option('s') || $this->option('fs')) {
            $this->seed();
        }
    }

    public function handleTraditionalMigrations()
    {
        $command = 'migrate';

        if ($this->option('f') || $this->option('fs')) {
            $command .= ':fresh';
        }

        Artisan::call($command . ' --force');
    }

    public function handleAutomaticMigrations()
    {
        $path = is_dir(app_path('Models')) ? app_path('Models') : app_path();
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
        $command = 'db:seed --force';

        Artisan::call($command);

        $this->info('Seeding complete!');
    }
}
