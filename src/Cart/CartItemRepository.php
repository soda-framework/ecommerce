<?php

namespace Soda\Ecommerce\Cart;

use Event;
use Ecommerce;
use Soda\Ecommerce\Foundation\Constants;
use Illuminate\Database\Eloquent\Collection;
use Soda\Ecommerce\Cart\Events\CartItemWasRemoved;
use Soda\Ecommerce\Cart\Interfaces\CartItemInterface;
use Soda\Ecommerce\Product\Interfaces\StoreProductInterface;
use Soda\Ecommerce\Cart\Interfaces\CartItemRepositoryInterface;
use Soda\Ecommerce\Foundation\Exceptions\InvalidPriceException;

class CartItemRepository implements CartItemRepositoryInterface
{
    /**
     * @var CartItemInterface
     */
    protected $cartItems;

    /**
     * CartItemRepository constructor.
     *
     * @param CartItemInterface $cartItems
     */
    public function __construct(CartItemInterface $cartItems)
    {
        $this->cartItems = $cartItems;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteByProductId($productId, $discontinued = false)
    {
        $productId = $this->resolveProductId($productId);

        $items = $this->cartItems->where('store_product_id', $productId);

        if (Event::hasListeners(CartItemWasRemoved::class)) {
            foreach ($items->get() as $item) {
                if ($discontinued) {
                    $item->discontinued = true;
                }

                $item->delete();
            }
        } else {
            $items->delete();
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return CartItemInterface
     * @throws InvalidPriceException
     */
    public function addVisitorProduct($productId, $quantity = 1, $unitPrice = null)
    {
        if ($productId instanceof StoreProductInterface) {
            $unitPrice = $productId->getPrice();
        }

        $productId = $this->resolveProductId($productId);

        if ($unitPrice === null) {
            throw new InvalidPriceException('Unit Price can not be null');
        } elseif ($unitPrice < 0) {
            throw new InvalidPriceException('Unit Price must be greater than 0');
        }

        $item = $this->getVisitorItemByProductId($productId);
        $item->incrementQuantity($quantity);
        $item->setUnitPrice($unitPrice);
        $item->save();

        return $item;
    }

    /**
     * {@inheritdoc}
     *
     * @return CartItemInterface
     */
    public function setVisitorProductQuantity($productId, $quantity)
    {
        if ($quantity < 1) {
            return $this->removeVisitorProduct($productId);
        }

        $productId = $this->resolveProductId($productId);

        $item = $this->getVisitorItemByProductId($productId);

        if ($item->exists) {
            $item->setQuantity($quantity);
            $item->save();
        }

        return $item;
    }

    /**
     * {@inheritdoc}
     *
     * @return CartItemInterface
     */
    public function removeVisitorProduct($productId)
    {
        $productId = $this->resolveProductId($productId);

        $item = $this->getVisitorItemByProductId($productId);
        $item->delete();

        return $item;
    }

    /**
     * {@inheritdoc}
     */
    public function clearVisitorCart()
    {
        $items = $this->cartItems->where([
            'store_id'     => Ecommerce::currentStore()->getId(),
            'visitor_id'   => Ecommerce::getVisitorId(),
            'visitor_type' => Ecommerce::getVisitorType(),
        ]);

        if (Event::hasListeners(CartItemWasRemoved::class)) {
            foreach ($items->get() as $item) {
                $item->delete();
            }
        } else {
            $items->delete();
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return Collection
     */
    public function getVisitorItems()
    {
        return $this->cartItems->where([
            'store_id'     => Ecommerce::currentStore()->getId(),
            'visitor_id'   => Ecommerce::getVisitorId(),
            'visitor_type' => Ecommerce::getVisitorType(),
        ])->get();
    }

    /**
     * {@inheritdoc}
     */
    public function moveSessionToCustomer($customerId)
    {
        return $this->cartItems->where([
            'store_id'     => Ecommerce::currentStore()->getId(),
            'visitor_id'   => Ecommerce::getVisitorId(),
            'visitor_type' => Ecommerce::getVisitorType(),
        ])->update([
            'visitor_id'   => $customerId,
            'visitor_type' => Constants::VISITOR_TYPE_REGISTERED,
        ]);
    }

    /**
     * Extracts id from StoreProductInterface model if possible, and returns integer id.
     *
     * @param $productId
     *
     * @return mixed
     */
    protected function resolveProductId($productId)
    {
        if ($productId instanceof StoreProductInterface) {
            $productId->getId();
        }

        return $productId;
    }

    /**
     * Fetches a cart row by product id, or creates a new row if none is found
     * It should be noted that if a new row is created, it is NOT saved to
     * the database.
     *
     * @param $productId
     *
     * @return CartItemInterface
     */
    protected function getVisitorItemByProductId($productId)
    {
        return $this->cartItems->firstOrNew([
            'store_product_id' => $productId,
            'store_id'         => Ecommerce::currentStore()->getId(),
            'visitor_id'       => Ecommerce::getVisitorId(),
            'visitor_type'     => Ecommerce::getVisitorType(),
        ]);
    }
}
