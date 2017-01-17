<?php

namespace Soda\Ecommerce\Foundation\Listeners;

use Soda\Ecommerce\Customer\Interfaces\CustomerInterface;
use Soda\Ecommerce\Cart\Interfaces\CartItemRepositoryInterface;

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
