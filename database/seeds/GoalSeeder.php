<?php

use Illuminate\Database\Seeder;
use Bdgt\Resources\Goal;

class GoalSeeder extends Seeder
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
            $amount = $faker->randomFloat(2, 0, 200);

            Goal::create([
                'id' => null,
                'user_id' => $faker->numberBetween(1, 30),
                'label' => $faker->word(),
                'start_date' => $faker->dateTimeBetween('-2 years'),
                'goal_date' => $faker->dateTimeBetween('now', '+2 years'),
                'amount' => $amount,
                'balance' => $faker->randomFloat(2, 0, $amount)
            ]);
        }
    }
}
