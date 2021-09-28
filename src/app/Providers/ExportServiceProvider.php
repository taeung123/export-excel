<?php

namespace VCComponent\Laravel\Export\Providers;

use Illuminate\Support\ServiceProvider;
use VCComponent\Laravel\Export\Entities\ExportsQuery;
use VCComponent\Laravel\Export\Repositories\ExportsQueryRepository;
use VCComponent\Laravel\Export\Repositories\ExportsQueryRepositoryEloquent;
use VCComponent\Laravel\Export\Contracts\ExportPolicyInterface;
use VCComponent\Laravel\Export\Policies\ExportPolicy;

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
        $this->app->bind('export_query', ExportsQuery::class);
        $this->app->bind(ExportsQueryRepository::class, ExportsQueryRepositoryEloquent::class);
        $this->registerPolicies();
        $this->app->register(ExportAuthServiceProvider::class);
    }
    private function registerPolicies()
    {
        $this->app->bind(ExportPolicyInterface::class, ExportPolicy::class);
    }
}
