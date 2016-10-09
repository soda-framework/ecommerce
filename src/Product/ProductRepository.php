<?php

namespace Soda\Ecommerce\Product;

use Soda\Ecommerce\Product\Interfaces\ProductInterface;
use Soda\Ecommerce\Product\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    protected $products;

    /**
     * ProductRepository constructor.
     *
     * @param ProductInterface $products
     */
    public function __construct(ProductInterface $products)
    {
        $this->products = $products;
    }
}
