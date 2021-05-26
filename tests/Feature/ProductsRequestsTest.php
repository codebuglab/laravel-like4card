<?php

namespace CodeBugLab\Like4Card\Tests\Feature;

use CodeBugLab\Like4Card\Exceptions\ProductsNotFoundException;
use CodeBugLab\Like4Card\Tests\TestCase;
use CodeBugLab\Like4Card\Models\Like4CardProduct as Product;

class ProductsRequestsTest extends TestCase
{
    public function test_it_saves_products_came_from_api_with_passed_product_id()
    {
        $products = $this->like4Card::products([1]);

        $this->assertCount(1, $products);

        $product = $products[0];

        Product::create([
            "id" => $product->productId,
            "like4_card_category_id" => $product->categoryId,
            "name" => $product->productName,
            "price" => $product->productPrice,
            "sell_price" => $product->sellPrice,
            "image" => $product->productImage,
            "currency" => $product->productCurrency,
            "available" => $product->available,
            "vat_percentage" => $product->vatPercentage,
            "optional" => json_encode($product->productOptionalFields)
        ]);

        $this->assertDatabaseHas('like4_card_products', [
            'id' => 693,
            "name" => "mobilyTest",
        ]);
    }

    public function test_it_throws_an_exception_when_no_products_found()
    {
        $this->expectException(ProductsNotFoundException::class);
        $this->expectExceptionMessage("No available products");

        $this->like4Card::exceptionTestCase('no_products');
    }
}
