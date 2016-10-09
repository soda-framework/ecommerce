<?php

namespace Soda\Ecommerce\Foundation\Listeners;

use Soda\Ecommerce\Cart\Interfaces\CartItemRepositoryInterface;
use Soda\Ecommerce\Customer\Interfaces\CustomerInterface;

class AssignCartToCustomer
{
    protected $cartItems;

    /**
     * Create the event listener.
     *
     * @param CartItemRepositoryInterface $cartItems
     */
    public function __construct(CartItemRepositoryInterface $cartItems)
    {
        $this->cartItems = $cartItems;
    }

    /**
     * Handle the event.
     *
     * @param  $event
     *
     * @return void
     */
    public function handle($event)
    {
        if (isset($event->user) && $event->user instanceof CustomerInterface) {
            $this->cartItems->moveSessionToCustomer($event->user->id);
        }
    }
}
