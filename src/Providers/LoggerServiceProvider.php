<?php

namespace JuanDiii\LoggerService\Providers;

use Illuminate\Support\ServiceProvider;
use JuanDiii\LoggerService\Service\GuzzleClient;
use JuanDiii\LoggerService\Service\LogService;
use JuanDiii\LoggerService\Service\UserService;

class LoggerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/logger.php' => config_path('logger.php')
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('UserService', UserService::class);
        $this->app->bind('LogService', LogService::class);

        $this->app->singleton(GuzzleClient::class, function ($app) {
            return new GuzzleClient(config());
        });
    }

    public function provides()
    {
        return ['UserService', 'LogService'];
    }
}
