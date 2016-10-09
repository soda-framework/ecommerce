<?php

namespace Soda\Ecommerce\Order;

use Soda\Ecommerce\Order\Interfaces\OrderInterface;
use Soda\Ecommerce\Order\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    protected $orders;

    /**
     * OrderRepository constructor.
     *
     * @param OrderInterface $orders
     */
    public function __construct(OrderInterface $orders)
    {
        $this->orders = $orders;
    }
}
