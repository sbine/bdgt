<?php

use Illuminate\Database\Seeder;
use Bdgt\Resources\Bill;

class BillSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 7; $i++) {
            Bill::create([
                'id' => null,
                'start_date' => $faker->date(),
                'frequency' => $faker->numberBetween(7, 90),
                'label' => $faker->company(),
                'amount' => $faker->randomFloat(2, 0, 200)
            ]);
        }
    }
}
