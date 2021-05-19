<?php

namespace Akhaled\Like4Card\Tests\Feature;

use Akhaled\Like4Card\Tests\TestCase;
use Akhaled\Like4Card\Models\Like4CardOrder as Order;
use Akhaled\Like4Card\Models\Like4CardProduct as Product;

class OrdersRequestsTest extends TestCase
{
    public function test_it_saves_orders_came_from_api()
    {
        $orders = $this->like4Card::orders();

        $this->assertCount(1, $orders->data);

        $order = $orders->data[0];

        Order::create([
            "order_number" => $order->orderNumber,
            "final_total" => $order->orderFinalTotal,
            "currency" => $order->currencySymbol,
            "create_date" => $order->orderCreateDate,
            "payment_method" => $order->orderPaymentMethod,
            "current_status" => $order->orderCurrentStatus,
        ]);

        $this->assertDatabaseHas('like4_card_orders', [
            "order_number" => "12637610",
        ]);
    }
}
