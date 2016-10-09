<?php

namespace Soda\Ecommerce\Cart;

use Illuminate\Support\Collection;
use Soda\Ecommerce\Cart\Events\CartWasEmptied;
use Soda\Ecommerce\Cart\Events\ItemWasAddedToCart;
use Soda\Ecommerce\Cart\Events\ItemWasRemovedFromCart;
use Soda\Ecommerce\Cart\Interfaces\CartInstanceInterface;
use Soda\Ecommerce\Cart\Interfaces\CartItemInterface;
use Soda\Ecommerce\Cart\Interfaces\CartItemRepositoryInterface;

class CartInstance implements CartInstanceInterface
{
    /**
     * The repository used to interact with the cart database
     *
     * @var CartRepositoryInterface
     */
    protected $cart;

    /**
     * Collection of items in the cart
     *
     * @var Collection
     */
    protected $items;

    /**
     * Boolean to determine whether items have been loaded.
     * Used to prevent multiple unnecesary sql queries
     *
     * @var bool
     */
    protected $itemsLoaded = false;

    /**
     * Cart constructor.
     *
     * @param CartItemRepositoryInterface $cart
     */
    public function __construct(CartItemRepositoryInterface $cart)
    {
        $this->cart = $cart;
        $this->items = new Collection;
    }

    /**
     * {@inheritDoc}
     *
     * @return int
     */
    public function countItems()
    {
        return $this->hasItems() ? $this->getItems()->sum('quantity') : 0;
    }

    /**
     * {@inheritDoc}
     *
     * @return bool
     */
    public function hasItems()
    {
        return $this->countUniqueItems() ? true : false;
    }

    /**
     * {@inheritDoc}
     *
     * @return int
     */
    public function countUniqueItems()
    {
        return count($this->getItems());
    }

    /**
     * {@inheritDoc}
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getItems()
    {
        if (!$this->itemsLoaded) {
            $this->loadItems();
            $this->itemsLoaded = true;
        }

        return $this->items;
    }

    /**
     * {@inheritDoc}
     *
     * @param      $productId
     * @param int  $quantity
     * @param null $unitPrice
     *
     * @return $this
     * @throws InvalidPriceException
     */
    public function addItem($productId, $quantity = 1, $unitPrice = null)
    {
        if ($quantity >= 1) {
            $item = $this->cart->addVisitorProduct($productId, $quantity, $unitPrice);

            $this->updateItem($item);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @param     $productId
     * @param int $quantity
     *
     * @return $this|Cart
     */
    public function setItemQuantity($productId, $quantity)
    {
        if ($quantity < 1) {
            return $this->removeItem($productId);
        }

        $item = $this->cart->setVisitorProductQuantity($productId, $quantity);

        $this->updateItem($item);

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @param $productId
     *
     * @return $this
     */
    public function removeItem($productId)
    {
        $item = $this->cart->removeVisitorProduct($productId);

        $this->updateItem($item);

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return $this;
     */
    public function clear()
    {
        $this->cart->clearVisitorCart();

        $this->items = new Collection;

        event(new CartWasEmptied);

        return $this;
    }

    /**
     * Loads cart items from the database into the visitor's cart
     *
     * @return $this
     */
    protected function loadItems()
    {
        $this->items = $this->cart->getVisitorItems()->keyBy('id');

        return $this;
    }

    /**
     * Updates the cart items collection if it has already been loaded,
     * to prevent further database calls later on
     *
     * @param CartItemInterface $item
     *
     * @return $this
     */
    protected function updateItem(CartItemInterface $item)
    {
        if ($this->itemsLoaded) {
            if ($item->exists) {
                $this->items = $this->getItems()->put($item->getId(), $item);
            } else {
                $this->items->forget($item->getId());
            }
        }

        return $this;
    }
}
