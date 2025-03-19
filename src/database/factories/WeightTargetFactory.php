<?php

namespace Database\Factories;

use App\Models\WeightTarget;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
// database/factories/WeightTargetFactory.php
class WeightTargetFactory extends Factory
{
    protected $model = WeightTarget::class;

    public function definition()
    {
        return [
            'user_id' => 1,
            'target_weight' => $this->faker->randomFloat(1, 50, 70),
        ];
    }
}
