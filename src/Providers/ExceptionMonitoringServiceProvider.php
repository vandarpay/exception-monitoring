<?php

namespace VandarPay\ExceptionMonitoring\Providers;

use VandarPay\ExceptionMonitoring\Services\ExceptionMonitoring;
use Illuminate\Support\ServiceProvider;

class ExceptionMonitoringServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        foreach (glob(__DIR__.'/../Helpers'.'/*.php') as $file) {
            require_once $file;
        }

        $this->mergeConfigFrom(__DIR__.'/../Configs/config.php', 'exception-monitoring');

        $this->app->bind('exceptionMonitoring', function () {
            return new ExceptionMonitoring();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {

        $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');


        if ($this->app->runningInConsole()) {
            //configs
            $this->publishes(
                [
                    __DIR__.'/../Configs/config.php' => config_path('exception-monitoring.php'),
                ],
                'config'
            );
        }
    }
}
