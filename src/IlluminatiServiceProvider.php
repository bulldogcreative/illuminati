<?php

namespace Bulldog\Illuminati;

use Bulldog\Illuminati\Commands\InterfaceCommand;
use Bulldog\Illuminati\Commands\RepositoryCommand;
use Illuminate\Support\ServiceProvider;

class IlluminatiServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'bulldog');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'bulldog');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/illuminati.php', 'illuminati');

        // Register the service the package provides.
        $this->app->singleton('illuminati', function ($app) {
            return new Illuminati;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['illuminati'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/illuminati.php' => config_path('illuminati.php'),
        ], 'illuminati.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/bulldog'),
        ], 'illuminati.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/bulldog'),
        ], 'illuminati.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/bulldog'),
        ], 'illuminati.views');*/

        // Registering package commands.
        $this->commands([
            RepositoryCommand::class,
            InterfaceCommand::class,
        ]);
    }
}
