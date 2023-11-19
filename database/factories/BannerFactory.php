<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    public function definition()
    {
        return [
            'url' => fake()->imageUrl($width = 640, $height = 480),
            'status' => random_int(0,1)
        ];
    }
}
