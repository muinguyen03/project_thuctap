<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Promotion;
use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Banner::factory(5)->create();
        Category::factory(5)->create();
        // User::factory(5)->create();
        // Promotion::factory(5)->create();
    }
}
