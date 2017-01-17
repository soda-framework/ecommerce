<?php

namespace Soda\Ecommerce\Foundation\Providers;

use Illuminate\Support\ServiceProvider;
use Soda\Ecommerce\Foundation\Console\Seed;
use Soda\Ecommerce\Foundation\Console\Assets;
use Soda\Ecommerce\Foundation\Console\Config;
use Soda\Ecommerce\Foundation\Console\Update;
use Soda\Ecommerce\Foundation\Console\Migrate;

class CommandsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            Update::class,
            Assets::class,
            Migrate::class,
            Seed::class,
            Config::class,
        ]);
    }
}
