<?php
namespace Soda\Ecommerce\Customer\Interfaces;

interface CustomerAddressInterface
{
    /**
     * Get the customer associated with the address.
     */
    public function customer();
}
