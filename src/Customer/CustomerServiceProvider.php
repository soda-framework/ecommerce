<?php

namespace Soda\Ecommerce\Customer;

use Illuminate\Support\ServiceProvider;
use Soda\Ecommerce\Customer\Models\Customer;
use Soda\Ecommerce\Customer\Models\CustomerAddress;
use Soda\Ecommerce\Customer\Interfaces\CustomerInterface;
use Soda\Ecommerce\Customer\Interfaces\CustomerAddressInterface;

class CustomerServiceProvider extends ServiceProvider
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
        $this->app->bind(CustomerInterface::class, Customer::class);
        $this->app->bind(CustomerAddressInterface::class, CustomerAddress::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            CustomerInterface::class,
            CustomerAddressInterface::class,
        ];
    }
}
