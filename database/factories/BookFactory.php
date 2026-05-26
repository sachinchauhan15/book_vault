<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'author' => fake()->name(),
            'cover_image' => null,
            'price' => fake()->randomFloat(2, 5, 250),
            'published_date' => fake()->dateTimeBetween('-20 years', 'now')->format('Y-m-d'),
        ];
    }
}
