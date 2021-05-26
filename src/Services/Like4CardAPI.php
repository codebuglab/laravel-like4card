<?php

/**
 * Like4Card API
 *
 * @author Amro Khaled
 * @license MIT
 */

namespace CodeBugLab\Like4Card\Services;

use Exception;
use Illuminate\Support\Carbon;
use CodeBugLab\Like4Card\Contracts\Like4CardInterface;
use CodeBugLab\Like4Card\Exceptions\ProductsNotFoundException;
use CodeBugLab\Like4Card\Exceptions\WrongCredentialsException;

class Like4CardAPI implements Like4CardInterface
{
    /**
     * Like4Card base API url
     *
     * @property string
     */
    protected const API_URL = "https://taxes.like4app.com/online/";

    /**
     * Send POST cURL request to like4card server.
     *
     * @param  string  $url
     * @param  array  $json
     * @return object
     */
    private static function cURL($url, $json = [])
    {
        $response = self::executeCURL($url, $json);

        if ($response->response > 0) {
            return $response;
        }

        switch (optional($response)->message) {
            case "Incorrect Login - invalid email or password":
                throw new WrongCredentialsException($response->message);
            case "No available products":
                throw new ProductsNotFoundException($response->message);
            default:
                throw new Exception(optional($response)->message ?? "Unknown error");
        }
    }

    /**
     * Prepare CURL options before execution
     *
     * @param string $url
     * @param array $json
     * @return object
     */
    private static function executeCURL(string $url, array $json)
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
        return optional(
            self::cURL(
                "categories"
            )
        )->data;
    }

    /**
     * Return products by products ids
     *
     * @param array $ids
     * @return object
     */
    public static function products(array $ids)
    {
        return optional(
            self::cURL(
                "products",
                [
                    "ids[]" => implode(",", $ids)
                ]
            )
        )->data;
    }

    /**
     * Return products by category id
     *
     * @param int $category_id
     * @return object
     */
    public static function getProductsByCategoryId(int $category_id)
    {
        return optional(
            self::cURL(
                "products",
                ["categoryId" => $category_id]
            )
        )->data;
    }

    /**
     * Return orders by this merchant
     *
     * @param array $options
     * @return object
     */
    public static function orders(array $options = [])
    {
        return optional(
            self::cURL(
                "orders",
                $options
            )
        )->data;
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

        $order = self::cURL(
            "create_order",
            [
                'referenceId' => $local_id,
                'productId' => $product_id,
                'quantity' => 1,
                'time' => $time,
                'hash' => self::generateHash($time)
            ]
        );

        logger($order);

        return $order;
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
}
