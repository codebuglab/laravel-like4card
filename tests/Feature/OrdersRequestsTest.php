<?php

namespace Akhaled\Like4Card\Tests\Feature;

use Akhaled\Like4Card\Tests\TestCase;
use Akhaled\Like4Card\Models\Like4CardOrder as Order;
use Akhaled\Like4Card\Models\Like4CardSerial as Serial;

class OrdersRequestsTest extends TestCase
{
    public function test_it_saves_orders_came_from_api_to_database()
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

    public function test_it_gets_save_single_order_info_and_its_serials_to_database_using_api()
    {
        $order = $this->like4Card::order(1);

        $this->assertCount(1, $order->serials);

        $db_order_model = Order::create([
            "order_number" => $order->orderNumber,
            "final_total" => $order->orderFinalTotal,
            "currency" => $order->currencySymbol,
            "create_date" => $order->orderCreateDate,
            "payment_method" => $order->orderPaymentMethod,
            "current_status" => $order->orderCurrentStatus,
        ]);

        foreach ($order->serials as $serial) {
            Serial::create([
                "like4_card_order_id" => $db_order_model->id,
                "like4_card_product_id" => $serial->productId,
                "serial_id" => $serial->serialId,
                "serial_code" => $serial->serialCode,
                "serial_number" => $serial->serialNumber,
                "valid_to" => $serial->validTo,
            ]);
        }

        $this->assertDatabaseHas('like4_card_orders', [
            "order_number" => "12319604",
        ]);

        $this->assertDatabaseHas('like4_card_serials', [
            "id" => $db_order_model->id,
            "serial_id" => "11562121",
        ]);
    }
}
