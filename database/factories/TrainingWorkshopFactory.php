<?php


namespace Database\Factories;

use App\Models\TrainingWorkshop;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainingWorkshopFactory extends Factory
{
    protected $model = TrainingWorkshop::class;

    public function definition()
    {
        return [
            'name_en' => $this->faker->title,
            'name_bn' => $this->faker->title,
            'image' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'created_at' => now(),
        ];
    }
}


