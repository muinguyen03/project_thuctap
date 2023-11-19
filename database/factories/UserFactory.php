<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'      => fake()->name(),
            'image'     => 'https://res.cloudinary.com/dteefej4w/image/upload/v1681474078/users/585e4bf3cb11b227491c339a_gtyczj.png',
            'email'     => fake()->unique()->safeEmail(),
            'phone'     => fake()->e164PhoneNumber(),
            'password'  => fake()->password(),
            'address'   => fake()->address(),
            'role'      => 2,
            'status'    => random_int(0,2)
        ];
    }
}
