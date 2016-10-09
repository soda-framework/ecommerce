<?php

namespace Soda\Ecommerce\Store;

use Soda\Ecommerce\Store\Interfaces\StoreInterface;
use Soda\Ecommerce\Store\Interfaces\StoreRepositoryInterface;

class StoreRepository implements StoreRepositoryInterface
{
    protected $stores;

    /**
     * StoreRepository constructor.
     *
     * @param StoreInterface $stores
     */
    public function __construct(StoreInterface $stores)
    {
        $this->stores = $stores;
    }
}
