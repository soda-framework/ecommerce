<?php

namespace Soda\Ecommerce\Cart\Interfaces;

interface CartItemRepositoryInterface
{
    /**
     * Deletes a product from all carts by product id.
     *
     * @param      $productId
     * @param bool $discontinued
     */
    public function deleteByProductId($productId, $discontinued = false);

    /**
     * Adds a product to the visitor's cart.
     *
     * @param      $productId
     * @param int  $quantity
     * @param null $unitPrice
     */
    public function addVisitorProduct($productId, $quantity = 1, $unitPrice = null);

    /**
     * Removes a product from the visitor's cart.
     *
     * @param $productId
     */
    public function removeVisitorProduct($productId);

    /**
     * Sets the quantity for the product in a visitor's cart, if it exists.
     *
     * @param $productId
     * @param $quantity
     */
    public function setVisitorProductQuantity($productId, $quantity);

    /**
     * Clears all items from a visitor's cart.
     */
    public function clearVisitorCart();

    /**
     * Grabs all items from a visitor's cart.
     */
    public function getVisitorItems();

    /**
     * Moves cart from session to registered user.
     *
     * @param $customerId
     */
    public function moveSessionToCustomer($customerId);
}
