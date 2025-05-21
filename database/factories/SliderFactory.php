<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title_en' => $this->faker->title,
            'title_bn' => $this->faker->title,
            'slug'=>$this->faker->title,
            'description_en' => $this->faker->text,
            'description_bn' => $this->faker->text,
            'slider_image' => $this->faker->imageUrl(),
            'sorting' => rand(1, 5), // Assuming roles range from 1 to 5
            'status' => $this->faker->randomElement(['Active','Inactive']),
            'created_at' => now(),
        ];
    }
}
