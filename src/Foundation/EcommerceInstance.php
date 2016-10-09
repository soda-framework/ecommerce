<?php
namespace Soda\Ecommerce\Foundation;

use Illuminate\Contracts\Auth\Guard;
use Session;
use Soda\Ecommerce\Cart\Interfaces\CartInstanceInterface;
use Soda\Ecommerce\Store\Interfaces\StoreInterface;

class EcommerceInstance
{
    /**
     * Current store being visited
     *
     * @var StoreInterface
     */
    protected $currentStore;

    /**
     * Auth guard associated with the store customer base
     *
     * @var Guard
     */
    protected $guard;

    /**
     * Associated helper cart instance
     *
     * @var CartInstanceInterface
     */
    protected $cart;

    /**
     * ID of visitor associated with cart
     *
     * @var string
     */
    protected $visitorId;

    /**
     * Type of visitor associated with cart
     *
     * @var string
     */
    protected $visitorType;

    /**
     * EcommerceInstance constructor.
     *
     * @param StoreInterface        $currentStore
     * @param CartInstanceInterface $cart
     * @param Guard                 $guard
     */
    public function __construct(StoreInterface $currentStore, CartInstanceInterface $cart, Guard $guard)
    {
        $this->currentStore = $currentStore;
        $this->guard = $guard;
        $this->cart = $cart;
    }

    /**
     * Get the associated cart instance
     *
     * @return CartInstanceInterface
     */
    public function cart()
    {
        return $this->cart;
    }

    /**
     * Get the current store instance
     *
     * @return StoreInterface
     */
    public function currentStore()
    {
        return $this->currentStore;
    }

    /**
     * Get the associated auth guard
     *
     * @return Guard
     */
    public function guard()
    {
        return $this->guard;
    }

    /**
     * Get the ID of the current visitor
     *
     * @return mixed
     */
    protected function getVisitorId()
    {
        if ($this->visitorId === null) {
            $this->visitorId = $this->getVisitorType() == Constants::VISITOR_TYPE_REGISTERED ? $this->guard()->user()->id : Session::getId();
        }

        return $this->visitorId;
    }

    /**
     * Get the type of the current visitor
     *
     * @return string
     */
    protected function getVisitorType()
    {
        if ($this->visitorType === null) {
            $this->visitorType = $this->guard()->check() ? Constants::VISITOR_TYPE_REGISTERED : Constants::VISITOR_TYPE_GUEST;
        }

        return $this->visitorType;
    }
}
