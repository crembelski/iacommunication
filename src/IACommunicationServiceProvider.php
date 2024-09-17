<?php

namespace draken\iacommunication;

use Illuminate\Support\ServiceProvider;

class IACommunicationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(OpenAI::class, function ($app) {
            return new OpenAI(config('iacommunication.api_key'));
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/iacommunication.php' => config_path('iacommunication.php'),
        ], 'config');
    }
}
