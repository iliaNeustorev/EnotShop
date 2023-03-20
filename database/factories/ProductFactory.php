<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(3, true),
            'description' => $this->faker->sentence(10),
            'slug'=> $this->faker->slug(),
            'price' => $this->faker->randomFloat(2, 1, 66,66),
            'category_id' => Category::get()->random()->id,      
        ];
    }
}
