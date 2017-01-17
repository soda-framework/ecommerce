<?php

namespace Soda\Ecommerce\Support\Facades;

use Illuminate\Support\Facades\Facade;

class EcommerceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'soda.ecommerce';
    }
}
