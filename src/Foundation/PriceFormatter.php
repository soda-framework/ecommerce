<?php

namespace Soda\Ecommerce\Foundation;

class PriceFormatter
{
    /**
     * Format a price and a quantity.
     *
     * @param $price
     * @param $quantity
     *
     * @return mixed
     */
    public static function formatPriceAndQuantity($price, $quantity)
    {
        return number_format(static::formatPrice($price) * $quantity);
    }

    /**
     * Format a singular price.
     *
     * @param $price
     *
     * @return float
     */
    public static function formatPrice($price)
    {
        return number_format($price, 2);
    }
}
