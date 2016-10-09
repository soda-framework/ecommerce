<?php

namespace Soda\Ecommerce\Order\Interfaces;

use Soda\Ecommerce\Support\Interfaces\QuantifiableItemInterface;

interface OrderItemInterface extends QuantifiableItemInterface
{
    /**
     * Get the order associated with the item.
     */
    public function order();

    /**
     * Get the product record associated with the item.
     */
    public function storeProduct();
}
