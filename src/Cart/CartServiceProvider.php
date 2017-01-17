<?php

namespace Soda\Ecommerce\Cart;

use Soda\Ecommerce\Cart\Models\Cart;
use Illuminate\Support\ServiceProvider;
use Soda\Ecommerce\Cart\Models\CartItem;
use Soda\Ecommerce\Cart\Interfaces\CartItemInterface;
use Soda\Ecommerce\Cart\Interfaces\CartInstanceInterface;
use Soda\Ecommerce\Cart\Interfaces\CartItemRepositoryInterface;

class CartServiceProvider extends ServiceProvider
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
        $this->app->bind(CartItemInterface::class, CartItem::class);
        $this->app->bind(CartItemRepositoryInterface::class, CartItemRepository::class);
        $this->app->singleton(CartInstanceInterface::class, CartInstance::class);

        $this->app->bind('soda.ecommerce.cart', CartInstanceInterface::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'soda.ecommerce.cart',
            CartInstanceInterface::class,
            CartItemInterface::class,
            CartItemRepositoryInterface::class,
        ];
    }
}
