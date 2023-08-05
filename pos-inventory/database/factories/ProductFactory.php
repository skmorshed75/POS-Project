<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Factory>
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
            'name' => $this->faker->words(3, true), // Generate a random name with 3 words
            'price' => $this->faker->randomFloat(2, 10, 1000), // Generate a random price between 10 and 1000 with 2 decimal places
            'unit' => $this->faker->randomElement(['kg', 'g', 'oz', 'lb', 'piece']), // Random unit
            'img_url' => $this->faker->imageUrl(200, 200, 'food'), // Generate a random image URL for food
        ];
    }
}
