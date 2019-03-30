<?php

use Illuminate\Database\Seeder;
use App\Resources\Category;

class CategorySeeder extends Seeder
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
            Category::create([
                'id' => null,
                'user_id' => $faker->numberBetween(1, 30),
                'label' => ucwords($faker->text(15)),
                'budgeted' => $faker->randomFloat(2, 0, 1000),
                'parent_category_id' => $faker->numberBetween(0, 2)
            ]);
        }
    }
}
