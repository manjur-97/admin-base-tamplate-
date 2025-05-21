<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Research>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [


            'book_category_id' => $this->faker->numberBetween(1,100),
            'name_en' => $this->faker->sentence,
            'name_bn' => $this->faker->sentence,
            'file' => $this->faker->imageUrl(),
            'published_date' => $this->faker->numberBetween(1,100),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'created_at' =>now(),
        ];
    }
}
