<?php

namespace Database\Factories;

use App\Models\FrontMenu;
use Illuminate\Database\Eloquent\Factories\Factory;

class FrontMenuFactory extends Factory
{
    protected $model = FrontMenu::class;

    public function definition()
    {
        return [
            'parent_id' => null, // Adjust if you want to set a parent ID
            'name_en' => $this->faker->word,
            'name_bn' => $this->faker->word,
            'slug' => $this->faker->slug,
            'sorting' => $this->faker->numberBetween(1, 100),
            'menu_type' => $this->faker->randomElement(['header', 'footer']),
            'target' => $this->faker->randomElement(['_self', '_blank']),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'created_at' => now(),
        ];
    }
}
