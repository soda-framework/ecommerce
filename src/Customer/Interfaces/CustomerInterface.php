<?php
namespace Soda\Ecommerce\Customer\Interfaces;

interface CustomerInterface
{
    /**
     * Get the store associated with the customer.
     */
    public function store();

    /**
     * Get the orders associated with the customer.
     */
    public function orders();

    /**
     * Get the addresses associated with the customer.
     */
    public function addresses();
}
