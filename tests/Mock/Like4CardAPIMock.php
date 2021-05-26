<?php

namespace CodeBugLab\Like4Card\Tests\Mock;

use Exception;
use CodeBugLab\Like4Card\Services\Like4CardAPI;
use CodeBugLab\Like4Card\Exceptions\ProductsNotFoundException;
use CodeBugLab\Like4Card\Exceptions\WrongCredentialsException;

class Like4CardAPIMock extends Like4CardAPI
{
    private static function cURL($url, $json = [])
    {
        $response = self::prepareCURL($url, $json);

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

    private static function prepareCURL($url, $json)
    {
        return json_decode(
            file_get_contents(
                sprintf("%s/data/%s.json", __DIR__, $url)
            )
        );
    }

    public static function balance()
    {
        return self::cURL('check_balance');
    }

    public static function categories()
    {
        return optional(self::cURL('categories'))->data;
    }

    public static function products(array $ids)
    {
        return optional(
            self::cURL(
                "products",
                [
                    ["ids[]" => implode(",", $ids)]
                ]
            )
        )->data;
    }

    public static function getProductsByCategoryId(int $category_id)
    {
        return optional(
            self::cURL(
                "products",
                ["categoryId" => $category_id]
            )
        )->data;
    }

    public static function orders($options = [])
    {
        return optional(self::cURL('orders'))->data;
    }

    public static function order(int $id)
    {
        return self::cURL('order');
    }

    public static function createOrder(int $product_id, int $local_id)
    {
        // want to know what the response looks like in real example
    }

    public static function exceptionTestCase(string $test_case)
    {
        return self::cURL($test_case);
    }
}
