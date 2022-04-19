<?php

namespace CodeBugLab\Like4Card\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use CodeBugLab\Like4Card\Models\Like4Cardlike4card@outlook.sa as Order;

class Like4CardOrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'order_number' => $this->faker->randomNumber,
            'total' => $this->faker->randomFloat(2),
            'currency' => $this->faker->currencyCode,
            'like4_card_create_date' => $this->faker->date,
            'payment_method' => $this->faker->creditCardType,
            'current_status' => $this->faker->firstName,
        ];
    }
}
