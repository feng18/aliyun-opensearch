<?php

namespace Sunny\OpenSearch;

use Illuminate\Support\ServiceProvider;

class OpenSearchServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/opensearch.php' => config_path('opensearch.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('search', function ($app) { //Container
            return new Search($app['config']);
        });
        //$this->app->alias('search', Search::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        //return ['search'];
    }
}
