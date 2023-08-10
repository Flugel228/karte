<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true),
            'quantity' => $this->faker->numberBetween(100, 5000),
            'price' => $this->faker->randomFloat(2, 1, 5000),
            'description' => $this->faker->sentences(6, true),
            'additional' => $this->faker->sentences(3, true),
            'category_id' => Category::get()->random()->id,
        ];
    }
}
