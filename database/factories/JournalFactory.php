<?php

namespace Database\Factories;

use App\Models\Journal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Research>
 */
class JournalFactory extends Factory
{
    protected $model = Journal::class;

    public function definition()
    {
        return [
            'name_en' => $this->faker->sentence,
            'name_bn' => $this->faker->sentence,
            'published_date' => $this->faker->numberBetween(1,100),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'created_at' =>now(),
        ];
    }
}
