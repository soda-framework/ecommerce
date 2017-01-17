<?php

namespace Soda\Ecommerce\Support\Interfaces;

interface QuantifiableItemInterface
{
    /**
     * Get the quantity for an item.
     *
     * @return int
     */
    public function getQuantity();

    /**
     * Set the quantity for an item.
     *
     * @param $quantity
     *
     * @return $this
     */
    public function setQuantity($quantity);

    /**
     * Increment the quantity of an item by a set amount.
     *
     * @param $by
     *
     * @return $this
     */
    public function incrementQuantity($by);

    /**
     * Decrement the quantity of an item by a set amount.
     *
     * @param $by
     *
     * @return $this
     */
    public function decrementQuantity($by);

    /**
     * Set the unit price for an item.
     *
     * @param $unitPrice
     *
     * @return $this
     */
    public function setUnitPrice($unitPrice);

    /**
     * Get the unit price for an item.
     *
     * @return float
     */
    public function getUnitPrice();

    /**
     * Get the adjusted unit price for an item.
     *
     * @return float
     */
    public function displayUnitPrice();

    /**
     * Display the total price for a number of items.
     *
     * @return float
     */
    public function displayTotal();
}
