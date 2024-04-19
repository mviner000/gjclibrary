<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Generate random user IDs within the range of 1 to 50
        $borrowedBy = rand(1, 50);
        $returnedBy = rand(1, 50);

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'slug' => Str::slug($this->faker->sentence),
            'borrowed_by' => $borrowedBy,
            'returned_by' => $returnedBy,
            'borrowed_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'returned_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            // Add other attributes as needed
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Book $book) {
            // Define logic after creating each book instance if needed
        });
    }
}
