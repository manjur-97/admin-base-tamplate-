<?php

namespace Database\Factories;

use App\Models\Research;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Research>
 */
class ResearchFactory extends Factory
{
    protected $model = Research::class;
    
    public function definition()
    {
        return [
            'title_en' => $this->faker->sentence,
            'title_bn' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(),
            'author_en' => $this->faker->words(3, true),
            'author_bn' => $this->faker->words(3, true),
            'published_year' => $this->faker->numberBetween(1,100),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'created_at' =>now(),
        ];
    }
}
