<?php

namespace Soda\Ecommerce\Cart\Interfaces;

interface CartInstanceInterface
{
    /**
     * Returns a collection of items in the cart
     */
    public function getItems();

    /**
     * Counts the quantity of items in the cart
     */
    public function countItems();

    /**
     * Counts the number of products in the cart
     */
    public function countUniqueItems();

    /**
     * Determines if there are any items in the cart
     */
    public function hasItems();

    /**
     * Adds an item to the cart, or increments the quantity by a set amount if it already exists
     *
     * @param      $productId
     * @param int  $quantity
     * @param null $unitPrice
     */
    public function addItem($productId, $quantity = 1, $unitPrice = null);

    /**
     * Removes an item from the cart
     *
     * @param $productId
     */
    public function removeItem($productId);

    /**
     * Sets the quantity for a given item in the cart, if it exists
     *
     * @param     $productId
     * @param int $quantity
     */
    public function setItemQuantity($productId, $quantity);

    /**
     * Removes all items from the cart
     */
    public function clear();
}
