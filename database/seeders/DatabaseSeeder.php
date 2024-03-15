<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone'=>'0',
            'lion_id'=>'0',
            'password'=>bcrypt('12345678'),
            'is_admin'=> true,
            'email_verified_at'=> date('h:i:s'),
        ]);

        \App\Models\Category::create([
            'name' => 'Business Services',
            'icon' => '<i class="fa-solid fa-business-time"></i>',
        ]);  \App\Models\Category::create([
            'name' => 'Education',
            'icon' => '<i class="fa-solid fa-book"></i>',
        ]);  \App\Models\Category::create([
            'name' => 'Retail',
            'icon' => '<i class="fa-solid fa-shop"></i>',
        ]);  \App\Models\Category::create([
            'name' => 'Corporation',
            'icon' => '<i class="fa-solid fa-building"></i>',
        ]);  \App\Models\Category::create([
            'name' => 'Food Service',
            'icon' => '<i class="fa-solid fa-bowl-food"></i>',
        ]);  \App\Models\Category::create([
            'name' => 'Insuronce',
            'icon' => '<i class="fa-solid fa-car-burst"></i>',
        ]);  \App\Models\Category::create([
            'name' => 'Law',
            'icon' => '<i class="fa-solid fa-scale-balanced"></i>',
        ]);  \App\Models\Category::create([
            'name' => 'Manufacturer',
            'icon' => '<i class="fa-solid fa-industry"></i>',
        ]);
    }
}
