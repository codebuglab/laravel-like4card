<?php

namespace CodeBugLab\Like4Card\Tests\Mock;

use CodeBugLab\Like4Card\Contracts\Like4CardInterface;

class Like4CardAPIMock implements Like4CardInterface
{
    public static function balance()
    {
        return json_decode('{
            "response": 1,
            "userId": "1",
            "balance": "100",
            "currency": "SAR"
        }');
    }

    public static function categories()
    {
        return json_decode('{
            "response": 1,
            "data": [
                {
                    "id": "59",
                    "categoryParentId": "0",
                    "categoryName": "iTunes",
                    "amazonImage": "https://likecard-space.fra1.digitaloceanspaces.com/categories/f33b9-it.png",
                    "childs": [
                        {
                            "id": "151",
                            "categoryParentId": "59",
                            "categoryName": "British iTunes",
                            "amazonImage": "https://likecard-space.fra1.digitaloceanspaces.com/categories/bb24a-bcd74-netherland.jpg"
                        }
                    ]
                }
            ]
        }')->data;
    }

    public static function products(array $ids)
    {
        return json_decode('{
            "response": 1,
            "data": [
                {
                    "productId": "693",
                    "categoryId": "267",
                    "productName": "mobilyTest",
                    "productPrice": 0.02,
                    "productImage": "https://likecard-space.fra1.digitaloceanspaces.com/products/066ce-x50.jpg",
                    "productCurrency": "SAR",
                    "optionalFieldsExist": 1,
                    "productOptionalFields": [
                    {
                        "id": 332,
                        "required": "1",
                        "defaultValue": "",
                        "hint": "USER ID",
                        "label": "USER ID",
                        "fieldTypeId": "10",
                        "fieldCode": "userid",
                        "optionalFieldID": "14",
                        "options": []
                    }
                    ],
                    "sellPrice": "0.02",
                    "available": true,
                    "vatPercentage": 0
                }
            ]
        }')->data;
    }

    public static function getProductsByCategoryId(int $category_id)
    {
        return json_decode('{
            "response": 1,
            "data": [
                {
                    "productId": "693",
                    "categoryId": "267",
                    "productName": "mobilyTest",
                    "productPrice": 0.02,
                    "productImage": "https://likecard-space.fra1.digitaloceanspaces.com/products/066ce-x50.jpg",
                    "productCurrency": "SAR",
                    "optionalFieldsExist": 1,
                    "productOptionalFields": [
                    {
                        "id": 332,
                        "required": "1",
                        "defaultValue": "",
                        "hint": "USER ID",
                        "label": "USER ID",
                        "fieldTypeId": "10",
                        "fieldCode": "userid",
                        "optionalFieldID": "14",
                        "options": []
                    }
                    ],
                    "sellPrice": "0.02",
                    "available": true,
                    "vatPercentage": 0
                }
            ]
        }')->data;
    }

    public static function orders($options = [])
    {
        return json_decode('{
            "response": 1,
            "data": [
                {
                    "orderNumber": "12637610",
                    "orderFinalTotal": "1.05",
                    "currencySymbol": "SAR",
                    "orderCreateDate": "2020/01/06 12:07",
                    "orderCurrentStatus": "completed",
                    "orderPaymentMethod": "Pocket"
                }
            ]
        }')->data;
    }

    public static function order(int $id)
    {
        return json_decode('{
            "response": 1,
            "orderNumber": "12319604",
            "orderFinalTotal": "100",
            "currencySymbol": "SAR",
            "orderCreateDate": "2019-12-25 06:57",
            "orderPaymentMethod": "Pocket",
            "orderCurrentStatus": "completed",
            "serials": [
                {
                    "productId": "376",
                    "productName": "test-itunes1",
                    "productImage": "https://likecard-space.fra1.digitaloceanspaces.com/products/4b09d-5656b-buy-one-get-one-2.png",
                    "serialId": "11562121",
                    "serialCode": "U0IycUdUWktsL25UaGhOc2JBMmtTUT09",
                    "serialNumber": "",
                    "validTo": "25/03/2020"
                }
            ]
        }');
    }

    public static function createOrder(int $product_id, int $local_id)
    {
        // want to know what the response looks like in real example
    }
}
