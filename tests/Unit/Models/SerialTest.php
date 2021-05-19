<?php

namespace CodeBugLab\Like4Card\Tests\Unit\Models;

use CodeBugLab\Like4Card\Tests\TestCase;
use CodeBugLab\Like4Card\Models\Like4CardOrder as Order;
use CodeBugLab\Like4Card\Models\Like4CardSerial as Serial;
use CodeBugLab\Like4Card\Models\Like4CardProduct as Product;
use CodeBugLab\Like4Card\Models\Like4CardCategory as Category;

class SerialTest extends TestCase
{
    public function test_it_gets_order_from_serial()
    {
        $orders = Order::factory()
            ->count(2)
            ->create();

        foreach ($orders as $order) {
            $last_serials_collection = Serial::factory()->count(3)->create([
                'like4_card_order_id' => $order->id,
                'like4_card_product_id' => Product::factory()->create([
                    'like4_card_category_id' => Category::factory()->create()->id,
                ])->id,
            ]);
        }

        $this->assertEquals(
            $orders->last()->order_number,
            Serial::find($last_serials_collection->first()->id)
                ->order
                ->order_number
        );
    }

    public function test_it_gets_product_from_serial()
    {
        $products = Product::factory()->count(2)->create([
            'like4_card_category_id' => Category::factory()->create()->id,
        ]);

        foreach ($products as $product) {
            $last_serials_collection = Serial::factory()->count(3)->create([
                'like4_card_product_id' => $product->id,
                'like4_card_order_id' => Order::factory()->create()->id,
            ]);
        }

        $this->assertEquals(
            $products->last()->name,
            Serial::find($last_serials_collection->first()->id)
                ->product
                ->name
        );
    }

    public function test_it_decrypt_serial_code()
    {
        $serial = Serial::factory()->create([
            'serial_code' => "U0IycUdUWktsL25UaGhOc2JBMmtTUT09",
            'like4_card_order_id' => Order::factory()->create()->id,
            'like4_card_product_id' => Product::factory()->create([
                'like4_card_category_id' => Category::factory()->create()->id,
            ])->id
        ]);

        $this->assertEquals("J43azsDBUZch", $serial->decryptSerialCode());
    }
}
