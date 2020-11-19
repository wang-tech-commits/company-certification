<?php

namespace MrwangTc\CompanyCertification;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use MrwangTc\CompanyCertification\Certification\Models\CompanyCertification;
use MrwangTc\CompanyCertification\Certification\Observers\CertificationObserver;

class ServiceProvider extends LaravelServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config/config.php' => config_path('companycertification.php')]);
            $this->publishes([__DIR__ . '/../database/migrations/' => database_path('migrations')]);
        }
        CompanyCertification::observe(CertificationObserver::class);
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'companycertification');
    }
}