<?php

namespace Soda\Ecommerce\Product\Interfaces;

interface ProductInterface
{
    /**
     * Get the store products associated with the base product.
     */
    public function storeProducts();
}
