<?php

use Illuminate\Database\Seeder;
use Bdgt\Resources\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        User::create([
            'id' => null,
            'username' => "admin",
            'email' => "admin@example.com",
            'password' => Hash::make("admin")
        ]);

        for ($i = 0; $i < 29; $i++) {
            User::create([
                'id' => null,
                'username' => $faker->userName(),
                'email' => $faker->email(),
                'password' => $faker->md5()
            ]);
        }
    }
}
