<?php

namespace CodeBugLab\Like4Card\Tests\Unit\Services;

use CodeBugLab\Like4Card\Exceptions\WrongCredentialsException;
use CodeBugLab\Like4Card\Tests\TestCase;

class Like4CardAPITest extends TestCase
{
    public function test_it_throws_an_exception_with_wrong_credentials()
    {
        $this->expectException(WrongCredentialsException::class);
        $this->expectExceptionMessage("Incorrect Login - invalid email or password");

        $this->like4Card::exceptionTestCase('wrong_credentials');
    }

    public function test_can_get_balance()
    {
        $response = $this->like4Card::balance();

        $this->assertEquals(100, $response->balance);
    }

    public function test_can_get_categories()
    {
        $response = $this->like4Card::categories();

        $this->assertCount(1, $response);
        $this->assertEquals("iTunes", $response[0]->categoryName);
        $this->assertCount(1, $response[0]->childs);
    }

    public function test_it_gets_products_by_ids()
    {
        $response = $this->like4Card::products([693]);

        $this->assertCount(1, $response);
        $this->assertEquals("mobilyTest", $response[0]->productName);
    }

    public function test_it_gets_categories_by_category_id()
    {
        $response = $this->like4Card::getProductsByCategoryId(267);

        $this->assertCount(1, $response);
        $this->assertEquals("mobilyTest", $response[0]->productName);
    }

    public function test_it_gets_orders()
    {
        $response = $this->like4Card::orders();

        $this->assertCount(1, $response);
        $this->assertEquals(12637610, $response[0]->orderNumber);
    }

    public function test_it_gets_single_order_details()
    {
        $response = $this->like4Card::order(12319604);

        $this->assertEquals(12319604, $response->orderNumber);
    }
}
