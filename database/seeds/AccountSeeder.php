<?php

use Illuminate\Database\Seeder;
use Bdgt\Resources\Account;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 3; $i++) {
            Account::create([
                'id' => null,
                'date_opened' => $faker->dateTimeBetween('-10 years'),
                'name' => $faker->creditCardType(),
                'balance' => $faker->randomFloat(2, 0, 1000),
                'interest' => $faker->randomFloat(2, 0, 1),
                'interest_period' => $faker->numberBetween(1, 12)
            ]);
        }
    }
}
