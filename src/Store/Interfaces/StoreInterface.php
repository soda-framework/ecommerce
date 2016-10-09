<?php

namespace Soda\Ecommerce\Store\Interfaces;

use Soda\Ecommerce\Support\Interfaces\HasProductsInterface;

interface StoreInterface
{
    /**
     * Get the products associated with the store.
     */
    public function products();

    /**
     * Get the customers associated with the store.
     */
    public function customers();

    /**
     * Get the orders associated with the store.
     */
    public function orders();

    /**
     * Get the carted products associated with the store.
     */
    public function cartedProdcuts();

    /**
     * Get the unique ID of the store
     */
    public function getId();
}
