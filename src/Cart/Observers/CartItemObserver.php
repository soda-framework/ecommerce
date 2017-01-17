<?php

namespace Soda\Ecommerce\Cart\Observers;

use Soda\Ecommerce\Cart\Events\CartWasUpdated;
use Soda\Ecommerce\Cart\Events\CartItemWasAdded;
use Soda\Ecommerce\Cart\Events\CartItemWasUpdated;
use Soda\Ecommerce\Cart\Interfaces\CartItemInterface;

class CartItemObserver
{
    /**
     * Listen to the CartItem updated event.
     *
     * @param  CartItemInterface $cartItem
     */
    public function updated(CartItemInterface $cartItem)
    {
        event(new CartItemWasUpdated($cartItem));
        event(new CartWasUpdated);
    }

    /**
     * Listen to the CartItem created event.
     *
     * @param  CartItemInterface $cartItem
     */
    public function created(CartItemInterface $cartItem)
    {
        event(new CartItemWasAdded($cartItem));
        event(new CartWasUpdated);
    }

    /**
     * Listen to the CartItem deleted event.
     *
     * @param  CartItemInterface $cartItem
     */
    public function deleted(CartItemInterface $cartItem)
    {
        event(new CartItemWasRemoved($cartItem));
        event(new CartWasUpdated);
    }
}
