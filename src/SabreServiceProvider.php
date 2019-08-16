<?php

namespace Ammonkc\Sabre;

use Ammonkc\SabreApi\Client;
use Ammonkc\Sabre\Contracts\Sabre as SabreContract;
use Illuminate\Support\ServiceProvider;

class SabreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'sabre');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'sabre');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('sabre.php'),
            ], 'sabre-config');

            // Publishing the migrations.
            /*$this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'migrations');*/

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/sabre'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/sabre'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/sabre'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'sabre');

        // Register the main class to use with the facade
        $this->app->singleton(SabreContract::class, function ($app) {
            return new Sabre($app, new Client($app['config']->get('sabre.defaults')));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['sabre'];
    }
}
