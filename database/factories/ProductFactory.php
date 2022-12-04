<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'=> fake()->sentence(),
            'slug' => Str::slug(fake()->sentence()),
            'user_id' => User::all()->random()->id,
            'category_id'=> Category::all()->random()->id,
            'sku_code'=> uniqid(),
            'short_description'=> fake()->paragraph(),
            'price'=> fake()->numberBetween(100, 1000),
            'sale_price'=> fake()->numberBetween(100, 1000),
            'add_info'=> fake()->paragraph(),
            'currency'=> "usd",
            'image'=> 'product.jpg',
        ];
    }
}
