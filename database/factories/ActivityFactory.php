<?php


namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    public function definition()
    {
        return [
            'title_en' => $this->faker->sentence,
            'title_bn' => $this->faker->sentence,
            'photo' => $this->faker->imageUrl(),
            'slug' => $this->faker->slug,
            'meta_title' => $this->faker->sentence,
            'meta_description' => $this->faker->paragraph,
            'meta_keyword' => $this->faker->words(3, true),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'created_at' =>now(),
        ];
    }
}


