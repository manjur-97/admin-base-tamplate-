<?php


namespace Database\Factories;

use App\Models\Publication;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicationFactory extends Factory
{
    protected $model = Publication::class;

    public function definition()
    {
        return [
            'title_en' => $this->faker->title,
            'title_bn' => $this->faker->title,
            'image' => $this->faker->imageUrl(),
            'author_en' => $this->faker->words(3, true),
            'author_bn' => $this->faker->words(3, true),
            'published_year' => $this->faker->optional(0.8, null)->year,
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'created_at' => now(),
        ];
    }
}


