<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        return [
            'name' => fake()->paragraph(),
            'price' => fake()->randomNumber(5, true),
            // 'image' => fake()->image(storage_path('app/public/products'),640,480, null, true),
            'product_category_id' => \App\Models\ProductCategory::factory(),
        ];
    }
}
