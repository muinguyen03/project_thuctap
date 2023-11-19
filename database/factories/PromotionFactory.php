<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PromotionFactory extends Factory
{
    public function definition()
    {
        return [
            'code' => fake()->imageUrl($width = 640, $height = 480),
            'exp' => fake()->dateTime($max = 'now', $timezone = 'Asia/Ho_Chi_Minh'),
            'discount' => fake()->randomNumber(10000,50000),
            'status' => fake()->randomNumber(0,1)
        ];
    }
}
