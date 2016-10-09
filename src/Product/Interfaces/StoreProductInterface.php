<?php

namespace Soda\Ecommerce\Product\Interfaces;

interface StoreProductInterface
{
    /**
     * Get the base product associated with the record.
     */
    public function product();

    /**
     * Get the store that owns the product.
     */
    public function store();

    /**
     * Get the unique identifier for the store product
     */
    public function getId();

    /**
     * Get the store's price for the product
     */
    public function getPrice();
}
