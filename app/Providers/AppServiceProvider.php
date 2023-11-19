<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
    ];
    public function register()
    {

    }
    public function boot()
    {
        Paginator::useBootstrap();
        $this->registerPolicies();

    }
}
