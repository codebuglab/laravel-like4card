<?php

namespace Akhaled\Like4Card\Tests\Unit\Models;

use Akhaled\Like4Card\Tests\TestCase;
use Akhaled\Like4Card\Models\Like4CardOrder as Order;
use Akhaled\Like4Card\Models\Like4CardSerial as Serial;
use Akhaled\Like4Card\Models\Like4CardProduct as Product;
use Akhaled\Like4Card\Models\Like4CardCategory as Category;

class OrderTest extends TestCase
{
    public function test_it_gets_orders_serials()
    {
        $orders = Order::factory()
            ->count(2)
            ->create()
            ->each(function (Order $order) {
                Serial::factory()->count(3)->create([
                    'like4_card_order_id' => $order->id,
                    'like4_card_product_id' => Product::factory()->create([
                        'like4_card_category_id' => Category::factory()->create()->id,
                    ])->id,
                ]);
            });

        $this->assertEquals(
            3,
            Order::find($orders->first()->id)
                ->serials
                ->count()
        );
    }
}
