<?php

/**
 * Like4Card API
 *
 * @author Amro Khaled
 * @license MIT
 */

namespace Akhaled\Like4Card\Services;

use Illuminate\Support\Carbon;
use Akhaled\Like4Card\Contracts\Like4CardInterface;

class Like4CardAPI implements Like4CardInterface
{
    /**
     * Like4Card base API url
     *
     * @property string
     */
    protected const API_URL = "https://taxes.like4app.com/online/";

    function __construct()
    {
        //
    }

    /**
     * Send POST cURL request to like4card server.
     *
     * @param  string  $url
     * @param  array  $json
     * @return object
     */
    protected static function cURL($url, $json = [])
    {
        $ch = curl_init();

        $headers = array();
        $headers[] = "cache-control: no-cache";

        curl_setopt($ch, CURLOPT_URL, self::API_URL . $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array_merge(self::getAuthParameters(), $json));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $response = curl_error($ch);
        }
        curl_close($ch);

        return json_decode($response);
    }

    /**
     * Get Auth parameters from config file
     *
     * @return array
     */
    protected static function getAuthParameters()
    {
        return [
            'deviceId' => config('like4card.device_id'),
            'email' => config('like4card.email'),
            'password' => config('like4card.password'),
            'securityCode' => config('like4card.security_code'),
            'langId' => config('like4card.lang_id'),
        ];
    }

    /**
     * Get merchant balance
     *
     * @return object
     */
    public static function balance()
    {
        return self::cURL(
            "check_balance"
        );
    }

    /**
     * Get Like4Card categories
     *
     * @return object
     */
    public static function categories()
    {
        return self::cURL(
            "categories"
        );
    }

    /**
     * Return products by products ids
     *
     * @param array $ids
     * @return object
     */
    public static function products(array $ids)
    {
        return self::cURL(
            "products",
            [
                "ids[]" => implode(",", $ids),
            ]
        );
    }

    /**
     * Return products by category id
     *
     * @param int $category_id
     * @return object
     */
    public static function getProductsByCategoryId(int $category_id)
    {
        return self::cURL(
            "products",
            [
                "categoryId" => $category_id,
            ]
        );
    }

    /**
     * Return orders by this merchant
     *
     * @param array $options
     * @return object
     */
    public static function orders(array $options = [])
    {
        return self::cURL(
            "orders",
            $options
        );
    }

    /**
     * Get sing order info by id
     *
     * @param int $id
     * @return object
     */
    public static function order(int $id)
    {
        return self::cURL(
            "orders/details",
            [
                'orderId' => $id
            ]
        );
    }

    /**
     * Get sing order info by id
     *
     * @param int $product_id
     * @param int $local_id
     * @return object
     */
    public static function createOrder(int $product_id, int $local_id)
    {
        $time = now();

        return self::cURL(
            "create_order",
            [
                'referenceId' => $local_id,
                'productId' => $product_id,
                'quantity' => 1,
                'time' => $time,
                'hash' => self::generateHash($time)
            ]
        );
    }

    /**
     * Api requires hash to be passed with new order
     *
     * @param Carbon $time
     * @return string
     */
    private static function generateHash(Carbon $time)
    {
        $email = strtolower(config('like4card.email'));
        $phone = "966577777777";
        $key = '8Tyr4EDw!2sN';
        return hash('sha256', $time . $email . $phone . $key);
    }

    /**
     * decrypting the `serialCode` in php
     *
     * @param string $encrypted_txt
     * @return string
     */
    private static function decryptSerial(string $encrypted_txt)
    {
        $secret_key = 't-3zafRa';
        $secret_iv = 'St@cE4eZ';
        $encrypt_method = 'AES-256-CBC';
        $key = hash('sha256', $secret_key);

        //iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        return openssl_decrypt(base64_decode($encrypted_txt), $encrypt_method, $key, 0, $iv);
    }
}
