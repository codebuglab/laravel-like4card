<?php

namespace CodeBugLab\Like4Card\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use CodeBugLab\Like4Card\Models\Like4CardSerial as Serial;

class Like4CardSerialFactory extends Factory
{
    protected $model = Serial::class;

    public function definition()
    {
        return [
            "serial_id" => $this->faker->randomNumber,
            "serial_code" => $this->faker->sha256,
            "serial_number" => $this->faker->randomNumber,
            "valid_to" => $this->faker->date,
        ];
    }
}
