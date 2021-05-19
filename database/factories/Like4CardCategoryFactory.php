<?php

namespace Akhaled\Like4Card\Database\Factories;

use Akhaled\Like4Card\Models\Like4CardCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class Like4CardCategoryFactory extends Factory
{
    protected $model = Like4CardCategory::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'image' => $this->faker->url
        ];
    }
}
