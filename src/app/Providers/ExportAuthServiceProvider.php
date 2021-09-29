<?php

namespace VCComponent\Laravel\Export\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use VCComponent\Laravel\Export\Contracts\ExportPolicyInterface;
use VCComponent\Laravel\Export\Entities\ExportsQuery;

class ExportAuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        ExportsQuery::class => ExportPolicyInterface::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
    }
}
