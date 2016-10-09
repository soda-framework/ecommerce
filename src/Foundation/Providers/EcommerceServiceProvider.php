<?php

namespace Soda\Ecommerce\Foundation\Providers;

use Illuminate\Support\ServiceProvider;
use Soda;
use Soda\Cms\Support\Traits\SodaServiceProviderTrait;
use Soda\Ecommerce\Cart\CartServiceProvider;
use Soda\Ecommerce\Customer\CustomerServiceProvider;
use Soda\Ecommerce\Customer\Interfaces\CustomerInterface;
use Soda\Ecommerce\Foundation\EcommerceInstance;
use Soda\Ecommerce\Order\OrderServiceProvider;
use Soda\Ecommerce\Product\ProductServiceProvider;
use Soda\Ecommerce\Store\Interfaces\StoreInterface;
use Soda\Ecommerce\Store\StoreServiceProvider;
use Soda\Ecommerce\Support\Facades\EcommerceFacade;

class EcommerceServiceProvider extends ServiceProvider
{
    use SodaServiceProviderTrait;

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
        require(__DIR__.'/../../Support/helpers.php');

        $this->publishes([__DIR__.'/../../../config' => config_path('soda.ecommerce')], 'soda.ecommerce.config');
        $this->publishes([__DIR__.'/../../../public' => public_path('soda/ecommerce')], 'soda.ecommerce.assets');

        $this->loadViewsFrom(__DIR__.'/../../../views', 'soda-ecommerce');

        $this->loadMigrationsFrom(__DIR__.'/../../../database/migrations');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->registerDependencies([
            RouteServiceProvider::class,
            EventServiceProvider::class,
            CustomerServiceProvider::class,
            StoreServiceProvider::class,
            OrderServiceProvider::class,
            ProductServiceProvider::class,
            CartServiceProvider::class,
        ]);

        $this->registerFacades([
            'Ecommerce' => EcommerceFacade::class,
        ]);

        $this->app->bind('soda.ecommerce', function ($app) {
            $application = $app['soda']->getApplication();

            $store = $app[StoreInterface::class];
            $cart = $app['soda.ecommerce.cart'];
            $guard = null;

            if ($application) {
                $current_store = $store->where('application_id', $application->id)->first();

                if ($current_store) {
                    $store = $current_store;
                    $guard = $this->registerStoreGuard($store);
                }
            }

            $auth = $app['auth']->guard($guard);

            return new EcommerceInstance($store, $cart, $auth);
        });
    }

    protected function registerStoreGuard(StoreInterface $store)
    {
        $key = 'store-'.$store->getKey();

        $this->app->config->set("auth.providers.$key", [
            'driver' => 'eloquent',
            'model'  => resolve_class(app(CustomerInterface::class)),
        ]);

        $this->app->config->set("auth.guards.$key", [
            'driver'   => 'session',
            'provider' => $key,
        ]);

        $this->app->config->set("auth.passwords.$key", [
            'provider' => $key,
            'email'    => 'auth.emails.password',
            'table'    => 'password_resets',
            'expire'   => 60,
        ]);

        return $key;
    }
}
