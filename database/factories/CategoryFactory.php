<?php

namespace Akhaled\Like4Card\Database\Factories;

use Akhaled\Like4Card\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'image' => $this->faker->url
        ];
    }
}
