<?php

namespace Casa\Generator;

use Illuminate\Support\ServiceProvider;
use Casa\Generator\Commands\APIGeneratorCommand;
use Casa\Generator\Commands\PublisherCommand;
use Casa\Generator\Commands\ScaffoldAPIGeneratorCommand;
use Casa\Generator\Commands\ScaffoldGeneratorCommand;

class GeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__.'/../../../config/generator.php';

        $this->publishes([
            $configPath => config_path('generator.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('mitul.generator.publish', function ($app) {
            return new PublisherCommand();
        });

        $this->app->singleton('mitul.generator.api', function ($app) {
            return new APIGeneratorCommand();
        });

        $this->app->singleton('mitul.generator.scaffold', function ($app) {
            return new ScaffoldGeneratorCommand();
        });

        $this->app->singleton('mitul.generator.scaffold_api', function ($app) {
            return new ScaffoldAPIGeneratorCommand();
        });

        $this->commands([
            'mitul.generator.publish',
            'mitul.generator.api',
            'mitul.generator.scaffold',
            'mitul.generator.scaffold_api',
        ]);
    }
}
