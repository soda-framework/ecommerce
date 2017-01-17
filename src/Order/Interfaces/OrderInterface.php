<?php

namespace Soda\Ecommerce\Order\Interfaces;

interface OrderInterface
{
    /**
     * Get the store associated with the order.
     */
    public function store();

    /**
     * Get the items associated with the order.
     */
    public function items();

    /**
     * Get the customer associated with the order.
     */
    public function customer();

    /**
     * Get the status of the order.
     */
    public function getStatus();

    /**
     * Set the status of the order.
     *
     * @param $status
     */
    public function setStatus($status);

    /**
     * Fill the order with items from the customer's cart.
     */
    public function fillFromCart();
}
