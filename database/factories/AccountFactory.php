<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\User;
use App\Providers\FakerProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition()
    {
        $this->faker->addProvider(new FakerProvider($this->faker));

        return [
            'date_opened' => $this->faker->dateTimeThisDecade()->format('Y-m-d H:i:s'),
            'name' => $this->faker->randomAccount(),
            'balance' => $this->faker->randomFloat(2, 0, 10000),
            'interest' => $this->faker->numberBetween(0, 20),
        ];
    }
}
