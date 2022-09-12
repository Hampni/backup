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
        $this->loadRoutesFrom(__DIR__ .'/../routes/backup.php');
        $this->loadViewsFrom(__DIR__ .'/../resources/views', 'backupdb');
        $this->loadMigrationsFrom(__DIR__ .'/../database/migrations');

        $this->publishes([
            __DIR__ . '/../resources/views' => app_path('Console/Commands/vendor/backup')
        ]);

        $this->publishes([
            __DIR__ . '/../config/backup.php' => config_path('backup.php')
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                BackupCommand::class,
            ]);
        }
    }
}
