<?php

namespace Akhaled\Like4Card;

interface Like4CardInterface
{
    /**
     * Get merchant balance
     *
     * @return object
     */
    public static function balance(): object;

    /**
     * Get Like4Card categories
     *
     * @return object
     */
    public static function categories(): object;

    /**
     * Get Like4Card products
     *
     * @param array $ids
     * @return object
     */
    public static function products(array $ids = []): object;

    /**
     * Get Like4Card orders
     *
     * @param array $options
     * @return object
     */
    public static function orders(array $options = []): object;

    /**
     * Get Like4Card single order
     *
     * @param int $id
     * @return object
     */
    public static function order(int $id): object;

    /**
     * Get Like4Card single order
     *
     * @param array $order
     * @return object
     */
    public static function createOrder(array $order): object;
}
