<?php

namespace Soda\Ecommerce\Customer;

use Soda\Ecommerce\Customer\Interfaces\CustomerInterface;
use Soda\Ecommerce\Customer\Interfaces\CustomerRepositoryInterface;

class CustomerRepository implements CustomerRepositoryInterface
{
    protected $customers;

    /**
     * CustomerRepository constructor.
     *
     * @param CustomerInterface $customers
     */
    public function __construct(CustomerInterface $customers)
    {
        $this->customers = $customers;
    }
}
