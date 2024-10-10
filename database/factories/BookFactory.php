<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(10),
            'author_id' => \App\Models\Author::factory(),
            'publisher_id' => \App\Models\Publisher::factory(),
            'published_year' => $this->faker->year(),
            'isbn' => $this->faker->isbn13(),
            'stock' => $this->faker->numberBetween(0, 100),
        ];
    }
}
