<?php

namespace VCComponent\Laravel\Export\Providers;

use Illuminate\Support\ServiceProvider;
use VCComponent\Laravel\Export\Entities\ExportsQuery;
use VCComponent\Laravel\Export\Repositories\ExportsQueryRepository;
use VCComponent\Laravel\Export\Repositories\ExportsQueryRepositoryEloquent;

class ExportServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
        $this->publishes([
            __DIR__ . '/../../config/export.php' => config_path('export.php'),
            __DIR__ . '/../../database/seeds/ExportsQuerySeeder.php'  => base_path('/database/seeds/ExportsQuerySeeder.php'),
        ]);
    }

    /**
     * Register any package services
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('exports_query', ExportsQuery::class);
        $this->app->bind(ExportsQueryRepository::class, ExportsQueryRepositoryEloquent::class);
    }
}
