<?php

namespace Akhaled\Like4Card;

interface Like4CardInterface
{
    /**
     * Get merchant balance
     *
     * @return object
     */
    public static function balance();

    /**
     * Get Like4Card categories
     *
     * @return object
     */
    public static function categories();

    /**
     * Get Like4Card products
     *
     * @param array $ids
     * @return object
     */
    public static function products(array $ids);

    /**
     * Get category products
     *
     * @param int $category_id
     * @return object
     */
    public static function getProductsByCategoryId(int $ids);

    /**
     * Get Like4Card orders
     *
     * @param array $options
     * @return object
     */
    public static function orders(array $options = []);

    /**
     * Get Like4Card single order
     *
     * @param int $id
     * @return object
     */
    public static function order(int $id);

    /**
     * Get Like4Card single order
     *
     * @param int $product_id
     * @param int $local_id
     * @return object
     */
    public static function createOrder(int $product_id, int $local_id);
}
