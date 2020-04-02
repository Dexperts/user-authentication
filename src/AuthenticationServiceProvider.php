<?php

namespace Dexperts\Authentication;

use Illuminate\Support\ServiceProvider;

class AuthenticationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
	    $this->mergeConfigFrom(
		    __DIR__.'/config/authentication.php', 'authentication'
	    );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	    $this->loadMigrationsFrom(__DIR__.'/database/migrations');
	    $this->loadRoutesFrom(__DIR__.'/routes.php');
	    $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'authentication');
	    $this->loadViewsFrom(__DIR__.'/resources/views', 'authentication');

	    $this->publishes([
		    __DIR__.'/config/authentication.php' => config_path('authentication.php'),
	    ]);
	    $this->publishes([
		    __DIR__.'/resources/views' => resource_path('views/vendor/authentication'),
	    ]);
	    $this->publishes([
		    __DIR__.'/resources/assets' => public_path('vendor/authentication'),
	    ], 'public');

    }
}
