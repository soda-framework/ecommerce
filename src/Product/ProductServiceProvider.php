<?php

namespace Soda\Ecommerce\Product;

use Illuminate\Support\ServiceProvider;
use Soda\Ecommerce\Product\Interfaces\ProductInterface;
use Soda\Ecommerce\Product\Interfaces\ProductRepositoryInterface;
use Soda\Ecommerce\Product\Interfaces\StoreProductInterface;
use Soda\Ecommerce\Product\Models\Product;
use Soda\Ecommerce\Product\Models\StoreProduct;

class ProductServiceProvider extends ServiceProvider
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
        $this->app->bind(ProductInterface::class, Product::class);
        $this->app->bind(StoreProductInterface::class, StoreProduct::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            ProductInterface::class,
            StoreProductInterface::class,
            ProductRepositoryInterface::class,
        ];
    }
}
