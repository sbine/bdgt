<?php

use Illuminate\Database\Seeder;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        // Ensure at least one transaction is created for the dummy user
        Transaction::create([
                'id' => null,
                'user_id' => 1,
                'date' => $faker->dateTimeBetween('-2 years'),
                'account_id' => $faker->numberBetween(1, 3),
                'category_id' => $faker->numberBetween(1, 3),
                'bill_id' => $faker->numberBetween(1, 7),
                'payee' => $faker->company(),
                'amount' => $faker->randomFloat(2, 0, 200),
                'inflow' => $faker->boolean(),
                'cleared' => $faker->boolean(),
                'flair' => 'lightgray'
            ]);

        for ($i = 0; $i < 30; $i++) {
            Transaction::create([
                'id' => null,
                'user_id' => $faker->numberBetween(1, 30),
                'date' => $faker->dateTimeBetween('-2 years'),
                'account_id' => $faker->numberBetween(1, 3),
                'category_id' => $faker->numberBetween(1, 3),
                'bill_id' => $faker->numberBetween(1, 7),
                'payee' => $faker->company(),
                'amount' => $faker->randomFloat(2, 0, 200),
                'inflow' => $faker->boolean(),
                'cleared' => $faker->boolean(),
                'flair' => 'lightgray'
            ]);
        }
    }
}
