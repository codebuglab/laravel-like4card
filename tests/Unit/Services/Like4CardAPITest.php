<?php

namespace Akhaled\Like4Card\Tests\Unit\Services;

use Akhaled\Like4Card\Tests\TestCase;

class Like4CardAPITest extends TestCase
{
    public function test_can_get_balance()
    {
        $response = $this->like4Card::balance();

        $this->assertEquals(100, $response->balance);
    }

    public function test_can_get_categories()
    {
        $response = $this->like4Card::categories();

        $this->assertCount(1, $response->data);
        $this->assertEquals("iTunes", $response->data[0]->categoryName);
        $this->assertCount(1, $response->data[0]->childs);
    }

    public function test_it_gets_products_by_ids()
    {
        $response = $this->like4Card::products([693]);

        $this->assertCount(1, $response->data);
        $this->assertEquals("mobilyTest", $response->data[0]->productName);
    }

    public function test_it_gets_categories_by_category_id()
    {
        $response = $this->like4Card::getProductsByCategoryId(267);

        $this->assertCount(1, $response->data);
        $this->assertEquals("mobilyTest", $response->data[0]->productName);
    }

    public function test_it_gets_orders()
    {
        $response = $this->like4Card::orders();

        $this->assertCount(1, $response->data);
        $this->assertEquals(12637610, $response->data[0]->orderNumber);
    }

    public function test_it_gets_single_order_details()
    {
        $response = $this->like4Card::order(12319604);

        $this->assertEquals(12319604, $response->orderNumber);
    }
}
