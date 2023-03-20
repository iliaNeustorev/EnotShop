<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(5)->create();
        // Category::factory(8)->hasImage(1)->create();
        // Product::factory(8)->hasImages(2)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Boobon',
        //     'email' => 'test222@example.com',
        //     'number' => '888555333444',
        //     'password' => Hash::make('password'),
        // ]);
    }
}
