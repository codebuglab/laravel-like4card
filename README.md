# Laravel Like4Card <!-- omit in toc -->

Integrate [Like4Card](http://like4card.com/) api with Laravel.

## Table of Contents <!-- omit in toc -->

- [Installation](#installation)
- [Config](#config)
- [Available api methods](#available-api-methods)
  - [Get merchant balance](#get-merchant-balance)
  - [Categories](#categories)
  - [Products by products ids](#products-by-products-ids)
  - [Products by category](#products-by-category)
  - [Get all orders](#get-all-orders)
  - [Get an order info](#get-an-order-info)
  - [Create new order](#create-new-order)
- [License](#license)

## Installation

Require via composer

```bash
composer require akhaled/laravel-like4card
```

In `config/app.php` file

```php
'providers' => [
    ...
    Akhaled\Like4Card\Like4CarderviceProvider::class,
    ...
];
```

## Config

Add your info to `.env` file

```txt
LIKE4CARD_DEVICE_ID=xxx
LIKE4CARD_EMAIL=xxx
LIKE4CARD_PASSWORD=xxx
LIKE4CARD_SECURITY_CODE=xxx
LIKE4CARD_LANG_ID=xxx
```

The config file looks like

```php
[
  'device_id' => env('LIKE4CARD_DEVICE_ID', null),
  'email' => env('LIKE4CARD_EMAIL', null),
  'password' => env('LIKE4CARD_PASSWORD', null),
  'security_code' => env('LIKE4CARD_SECURITY_CODE', null),
  'lang_id' => env('LIKE4CARD_LANG_ID', 1)
]
```

## Available api methods

### Get merchant balance

Operation that help the merchant to get his balance and user Id.

```php
$response = Like4Card::balance();
```

`$response` is an Object with the following parameters

| Parameter | Description                  |
| :-------- | :--------------------------- |
| response  | 1 for success, 0 for failure |
| userId    | merchant account identifier  |
| balance   | merchant account balance     |
| currency  |                              |


### Categories

Operation to get all categories available for this merchant.


```php
$response = Like4Card::categories();
```

`$response` is an Object with the following parameters

| Parameter | Description                                                                                                                                                                                                                                                                                                   |
| :-------- | :------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| response  | 1 for success, 0 for failure                                                                                                                                                                                                                                                                                  |
| data      | array of objects, each object represents a category, and every category have a Parameter children that represents an array of subcategories. In case children was empty that means this category doesn't have any subcategories, and the merchant can get products of this category immediately using its id. |


### Products by products ids

Operation to get all products available by an array of products identifiers.

```php
$product_ids = [1, 2, 3];
$response = Like4Card::products()->get($product_ids);
// or
$response = Like4Card::products($product_ids);
```

`$response` is an Object with the following parameters

| Parameter | Description                                        |
| :-------- | :------------------------------------------------- |
| response  | 1 for success, 0 for failure                       |
| data      | array of objects, each object represents a product |

**Every product has**

| Parameter             | Description                                                                        |
| :-------------------- | :--------------------------------------------------------------------------------- |
| productPrice          | that represents the product price including vat that the merchant paid for product |
| sellPrice             | that represents the price the customer pays for the product to the merchant.       |
| available             | determines if stock for this product is available or not.                          |
| optionalFieldsExist   | 1 optional fields required, 0 there are no required optional fields.               |
| productOptionalFields | array of optional fields where                                                     |

**Each optional field has**

| Parameter    | Description                                                           |
| :----------- | :-------------------------------------------------------------------- |
| id           | identifier of the optional field                                      |
| required     | '1' means it's required, '0' means it's optional and not required     |
| defaultValue | default value for this field                                          |
| hint         | placeholder for this field                                            |
| label        | label displayed on top of this field on UI                            |
| fieldTypeId  | 1 plaintext ,7 email address, 10 phone number ,other number plaintext |
| fieldCode    |                                                                       |
| options      | array of choices in case option is multi choice field                 |

### Products by category

Operation to get all products available by category id.

```php
$category_id = 1;
$response = Like4Card::products()->getByCategoryId($category_id);
```

`$response` is an Object with the following parameters

| Parameter | Description                                        |
| :-------- | :------------------------------------------------- |
| response  | 1 for success, 0 for failure                       |
| data      | array of objects, each object represents a product |

**Every product has**

| Parameter             | Description                                                                        |
| :-------------------- | :--------------------------------------------------------------------------------- |
| productPrice          | that represents the product price including vat that the merchant paid for product |
| sellPrice             | that represents the price the customer pays for the product to the merchant.       |
| available             | determines if stock for this product is available or not.                          |
| optionalFieldsExist   | 1 optional fields required, 0 there are no required optional fields.               |
| productOptionalFields | array of optional fields where                                                     |

**Each optional field has**

| Parameter    | Description                                                           |
| :----------- | :-------------------------------------------------------------------- |
| id           | identifier of the optional field                                      |
| required     | '1' means it's required, '0' means it's optional and not required     |
| defaultValue | default value for this field                                          |
| hint         | placeholder for this field                                            |
| label        | label displayed on top of this field on UI                            |
| fieldTypeId  | 1 plaintext ,7 email address, 10 phone number ,other number plaintext |
| fieldCode    |                                                                       |
| options      | array of choices in case option is multi choice field                 |

### Get all orders

Operation to get all orders made by this merchant. This api can receive the following options:

| Parameter  | Description                                                                     |
| :--------- | :------------------------------------------------------------------------------ |
| page       | page number(default is 1), where page size is fixed value of 100 order per page |
| order_type | desc or asc, arranged by order create date orderCreateDate                      |
| from       | get all orders with create date bigger than this timestamp                      |
| to         | get all orders with create date less than this timestamp                        |

```php
// all options are not required
$options = [
  'page' => 1,
  'order_type' => 'asc',
  'from' => 1621327053,
  'to' => 1623998253
];
$response = Like4Card::orders($options);
```

`$response` is an Object with the following parameters

| Parameter | Description                               |
| :-------- | :---------------------------------------- |
| response  | 1 for success, 0 for failure              |
| data      | array of objects(each represent an order) |

> each order object has orderFinalTotal which represent the price the merchant will pay for LikeCard for this order

### Get an order info

Operation to get one order details by its id.

```php
$order_id = 1;
$response = Like4Card::order($order_id);
```

`$response` is an Object with the following parameters

| Parameter | Description                                                          |
| :-------- | :------------------------------------------------------------------- |
| response  | 1 for success, 0 for failure                                         |
| serials   | array of objects, each object represent a purchased product details. |

**each serial object has**

| Parameter    | Description                                          |
| :----------- | :--------------------------------------------------- |
| serialCode   | is the encrypted serial given to customer to be used |
| serialNumber | is the card manufacturing No                         |
| validTo      | is the validation time for card                      |

### Create new order

Operation to create new order. This api can receive the following parameters:

| Parameter    | Description                                          |
| :----------- | :--------------------------------------------------- |
| product_id   | product identifier **Required**                      |
| reference_id | merchant reference **(Required and must be unique)** |
| quantity     | always 1                                             |

```php
$order = [
  'product_id' => 1,
  'reference_id' => 123, // the id from your local orders table
  'quantity' => 1
];
$response = Like4Card::createOrder($order);
```

`$response` is an Object with the following parameters

| Parameter | Description                  |
| :-------- | :--------------------------- |
| response  | 1 for success, 0 for failure |

## License

Laravel Like4Card is a free software distributed under the terms of the MIT license.
