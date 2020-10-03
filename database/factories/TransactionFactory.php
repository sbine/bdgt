<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Providers\FakerProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        $this->faker->addProvider(new FakerProvider($this->faker));
        $isInflow = $this->faker->optional(0.3, 0)->boolean();

        return [
            'date' => $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d H:i:s'),
            'payee' => $this->faker->name,
            'amount' => ($isInflow ? $this->faker->biasedNumberBetween(50, 3000, function ($x) {
                return cos($x);
            }) : $this->faker->randomAmount(3000)),
            'inflow' => $isInflow,
            'cleared' => $this->faker->boolean(),
            'flair' => $this->faker->randomFlair(),
        ];
    }
}
