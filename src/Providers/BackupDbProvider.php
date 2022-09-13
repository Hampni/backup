<?php

namespace Hampni\Backupdb\Providers;

use Hampni\Backupdb\Commands\BackupCommand;
use Illuminate\Support\ServiceProvider;

class BackupDbProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadMigrationsFrom(__DIR__ .'/../database/migrations');

        $this->publishes([
            __DIR__ . '/../config/backup.php' => config_path('backup.php')
        ]);

        $this->publishes([
            __DIR__ . '/../backups' => database_path('backups')
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                BackupCommand::class,
            ]);
        }
    }
}
