<?php

namespace Soda\Ecommerce\Store;

use Illuminate\Support\ServiceProvider;
use Soda\Ecommerce\Store\Interfaces\StoreInterface;
use Soda\Ecommerce\Store\Interfaces\StoreRepositoryInterface;
use Soda\Ecommerce\Store\Models\Store;

class StoreServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

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
        $this->app->bind(StoreInterface::class, Store::class);
        $this->app->bind(StoreRepositoryInterface::class, StoreRepository::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            StoreInterface::class,
            StoreRepositoryInterface::class,
        ];
    }
}
