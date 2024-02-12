<?php

namespace Database\Factories;
use App\Models\Book;

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
     *
     */

     protected $model = Book::class;


    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'published_date' => $this->faker->date,
            'publisher' => $this->faker->company,
            'pages' => $this->faker->numberBetween(100, 1000),
            'category' => $this->faker->word,
            'image' => 'https://via.placeholder.com/400x600.png?text=Book+Image',
        ];
    }
}
