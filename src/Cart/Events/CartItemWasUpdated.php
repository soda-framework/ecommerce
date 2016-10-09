<?php
namespace Soda\Ecommerce\Cart\Events;

use Ecommerce;
use Soda\Ecommerce\Cart\Interfaces\CartItemInterface;

class CartItemWasUpdated
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
