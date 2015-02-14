<?php

use Illuminate\Database\Seeder;
use Bdgt\Resources\Category;

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

        for ($i = 0; $i < 7; $i++) {
            Category::create([
                'id' => null,
                'label' => ucwords($faker->text(15)),
                'parent_category_id' => $faker->numberBetween(0, 2)
            ]);
        }
    }
}
