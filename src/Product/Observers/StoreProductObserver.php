<?php

namespace Soda\Ecommerce\Product\Observers;

use Soda\Ecommerce\Cart\Interfaces\CartItemRepositoryInterface;
use Soda\Ecommerce\Product\Interfaces\StoreProductInterface;

class StoreProductObserver
{
    /**
     * Listen to the StoreProduct deleted event.
     *
     * @param  StoreProductInterface $storeProduct
     */
    public function deleted(StoreProductInterface $storeProduct)
    {
        app(CartItemRepositoryInterface::class)->deleteByProductId($storeProduct->id, true);
    }
}
