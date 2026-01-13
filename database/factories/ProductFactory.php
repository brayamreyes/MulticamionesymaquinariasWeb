<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
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
    public function definition(): array {
        return [
            'category_id' => Category::all()->random()->id,
            'brand_id' => Brand::all()->random()->id,
            'plate' => fake()->randomLetter() . fake()->randomLetter() . fake()->randomLetter() . '-' . fake()->randomDigit() . fake()->randomDigit() . fake()->randomDigit(),
            'name' => fake()->name,
            'model' => fake()->name,
            'year_model' => fake()->year,
            'year_manufacture' => fake()->year,
            'mileage' => fake()->numberBetween(10000, 20000),
            'hours' => fake()->numberBetween(1000, 2000),
            'power' => fake()->numberBetween(1000, 2000) . 'HP',
            'dollar_price' => fake()->randomFloat(2, 10000, 50000),
            'pen_price' => fake()->randomFloat(2, 10000, 50000),
            'is_featured' => fake()->boolean,
        ];
    }
}
