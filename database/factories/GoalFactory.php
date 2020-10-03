<?php

namespace Database\Factories;

use App\Models\Goal;
use App\Providers\FakerProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoalFactory extends Factory
{
    protected $model = Goal::class;

    public function definition()
    {
        $this->faker->addProvider(new FakerProvider($this->faker));
        $amount = $this->faker->randomFloat(2, 0, 200);

        return [
            'label' => $this->faker->randomGoal(),
            'start_date' => $this->faker->dateTimeThisDecade()->format('Y-m-d'),
            'goal_date' => $this->faker->dateTimeBetween('now', '+10 years')->format('Y-m-d'),
            'balance' => $this->faker->randomFloat(2, 0, $amount),
            'amount' => $amount,
        ];
    }
}
