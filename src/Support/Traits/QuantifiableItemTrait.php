<?php

namespace Soda\Ecommerce\Support\Traits;

use Soda\Ecommerce\Foundation\PriceFormatter;

trait QuantifiableItemTrait
{
    /**
     * {@inheritDoc}
     *
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return $this
     */
    public function incrementQuantity($by)
    {
        $this->quantity += $by;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return $this
     */
    public function decrementQuantity($by)
    {
        $this->quantity -= $by;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return $this
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unit_price = $unitPrice;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return float
     */
    public function displayUnitPrice()
    {
        return PriceFormatter::formatPrice($this->getUnitPrice());
    }

    /**
     * {@inheritDoc}
     *
     * @return float
     */
    public function getUnitPrice()
    {
        return $this->unit_price;
    }

    /**
     * {@inheritDoc}
     *
     * @return float
     */
    public function displayTotal()
    {
        return PriceFormatter::formatPriceAndQuantity($this->getUnitPrice(), $this->getQuantity());
    }

    /**
     * {@inheritDoc}
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}
