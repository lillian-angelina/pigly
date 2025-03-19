<?php

namespace Database\Factories;

use App\Models\WeightLog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WeightLog>
 */
class WeightLogFactory extends Factory
{
    protected $model = WeightLog::class;

    public function definition()
    {
        return [
            'user_id' => 1,
            'date' => $this->faker->dateTimeBetween('-35 days', 'now')->format('Y-m-d'),
            'weight' => $this->faker->randomFloat(1, 50, 80),
            'calories' => $this->faker->numberBetween(1500, 3000),
            'exercise_time' => $this->faker->time(),
            'exercise_content' => $this->faker->sentence(),
        ];
    }
}