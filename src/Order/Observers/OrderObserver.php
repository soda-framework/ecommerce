<?php

namespace Soda\Ecommerce\Order\Observers;

use Soda\Ecommerce\Order\Events\OrderStatusChanged;
use Soda\Ecommerce\Order\Events\OrderWasPlaced;
use Soda\Ecommerce\Order\Interfaces\OrderInterface;

class OrderObserver
{
    /**
     * Listen to the Order updating event.
     *
     * @param  OrderInterface $order
     */
    public function updating(OrderInterface $order)
    {
        if ($order->isDirty('status')) {
            event(new OrderStatusChanged($order));
        }
    }

    /**
     * Listen to the Order created event.
     *
     * @param  OrderInterface $order
     */
    public function created(OrderInterface $order)
    {
        event(new OrderWasPlaced($order));
    }
}
