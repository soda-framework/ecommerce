<?php

namespace Soda\Ecommerce\Order;

use Soda\Ecommerce\Order\Models\Order;
use Illuminate\Support\ServiceProvider;
use Soda\Ecommerce\Order\Models\OrderItem;
use Soda\Ecommerce\Order\Interfaces\OrderInterface;
use Soda\Ecommerce\Order\Interfaces\OrderItemInterface;
use Soda\Ecommerce\Order\Interfaces\OrderRepositoryInterface;

class OrderServiceProvider extends ServiceProvider
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
        $this->app->bind(OrderInterface::class, Order::class);
        $this->app->bind(OrderItemInterface::class, OrderItem::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            OrderInterface::class,
            OrderItemInterface::class,
            OrderRepositoryInterface::class,
        ];
    }
}
