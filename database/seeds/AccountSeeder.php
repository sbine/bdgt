<?php

use Illuminate\Database\Seeder;
use App\Models\Account;

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

        for ($i = 0; $i < 20; $i++) {
            Account::create([
                'id' => null,
                'user_id' => $faker->numberBetween(1, 30),
                'date_opened' => $faker->dateTimeBetween('-10 years'),
                'name' => $faker->creditCardType(),
                'balance' => $faker->randomFloat(2, 0, 1000),
                'interest' => $faker->randomFloat(2, 0, 1),
                //'interest_period' => $faker->numberBetween(1, 12)
            ]);
        }
    }
}
