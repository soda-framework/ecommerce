<?php
namespace Soda\Ecommerce\Order\Events;

use Soda\Ecommerce\Order\Interfaces\OrderInterface;

class OrderStatusChanged
{
    public $order;

    /**
     * Create a new event instance.
     *
     * @param OrderInterface $order
     */
    public function __construct(OrderInterface $order)
    {
        $this->order = $order;
    }
}
