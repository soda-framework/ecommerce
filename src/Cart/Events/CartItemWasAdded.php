<?php

namespace Soda\Ecommerce\Cart\Events;

use Soda\Ecommerce\Cart\Interfaces\CartItemInterface;

class CartItemWasAdded
{
    public $cartItem;

    /**
     * Create a new event instance.
     *
     * @param CartItemInterface $cartItem
     */
    public function __construct(CartItemInterface $cartItem)
    {
        $this->cartItem = $cartItem;
    }
}
