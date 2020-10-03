<?php

namespace Database\Factories;

use App\Models\Bill;
use App\Providers\FakerProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillFactory extends Factory
{
    protected $model = Bill::class;

    public function definition()
    {
        $this->faker->addProvider(new FakerProvider($this->faker));

        return [
            'start_date' => $this->faker->dateTimeThisYear()->format('Y-m-d'),
            'frequency' => $this->faker->numberBetween(28, 60),
            'label' => $this->faker->randomBill(),
            'amount' => $this->faker->randomAmount(1200),
        ];
    }
}
