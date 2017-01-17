<?php

namespace Soda\Ecommerce\Cart\Interfaces;

use Soda\Ecommerce\Support\Interfaces\QuantifiableItemInterface;

interface CartItemInterface extends QuantifiableItemInterface
{
    /**
     * Get the store product associated with the cart item.
     */
    public function storeProduct();

    /**
     * Get the store associated with the cart item.
     */
    public function store();

    /**
     * Get the id of the cart items row.
     */
    public function getId();

    /**
     * Get the id of the store associated with the cart item.
     */
    public function getStoreId();

    /**
     * Get the id of the store product associated with the cart item.
     */
    public function getProductId();
}
