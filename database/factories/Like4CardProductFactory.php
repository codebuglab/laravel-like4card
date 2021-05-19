<?php

namespace CodeBugLab\Like4Card\Database\Factories;

use CodeBugLab\Like4Card\Models\Like4CardProduct as Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class Like4CardProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->randomNumber,
            'sell_price' => $this->faker->randomNumber,
            'image' => $this->faker->url,
            'currency' => $this->faker->currencyCode,
            "available" => $this->faker->boolean,
            "vat_percentage" => $this->faker->numberBetween(1, 100),
        ];
    }
}
