<?php

namespace Soda\Ecommerce\Support\Traits;

use Soda\Ecommerce\Foundation\PriceFormatter;

trait QuantifiableItemTrait
{
    /**
     * {@inheritdoc}
     *
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return $this
     */
    public function incrementQuantity($by)
    {
        $this->quantity += $by;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return $this
     */
    public function decrementQuantity($by)
    {
        $this->quantity -= $by;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return $this
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unit_price = $unitPrice;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return float
     */
    public function displayUnitPrice()
    {
        return PriceFormatter::formatPrice($this->getUnitPrice());
    }

    /**
     * {@inheritdoc}
     *
     * @return float
     */
    public function getUnitPrice()
    {
        return $this->unit_price;
    }

    /**
     * {@inheritdoc}
     *
     * @return float
     */
    public function displayTotal()
    {
        return PriceFormatter::formatPriceAndQuantity($this->getUnitPrice(), $this->getQuantity());
    }

    /**
     * {@inheritdoc}
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}
