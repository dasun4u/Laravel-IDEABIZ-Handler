<?php

namespace Dasun4u\LaravelIDEABIZHandler;

use Illuminate\Support\ServiceProvider;

/**
 * Class RestAPIProvider
 * @package Dasun4u\LaravelIDEABIZHandler
 */
class RestAPIProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/ideabiz.php' => config_path('ideabiz.php'),
        ]);
        $this->publishes([
            __DIR__ . '/../token.json' => storage_path('logs/ideabiz/token.json'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Dasun4u\LaravelIDEABIZHandler\IDEABIZ');

        $this->app->bind('ideabiz', function () {
            return new IDEABIZ();
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return ['ideabiz'];
    }
}
