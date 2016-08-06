<?php

use Bdgt\Resources\User;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Bdgt\Resources\User::class)->create([
            'id'       => 1,
            'username' => 'admin',
            'email'    => 'admin@example.com',
            'password' => Hash::make('admin')
        ])->each(function ($u) {
            $u->accounts()->saveMany(factory(Bdgt\Resources\Account::class, 5)->make());
            $u->bills()->saveMany(factory(Bdgt\Resources\Bill::class, 5)->make());
            $u->categories()->save(factory(Bdgt\Resources\Category::class)->make([
                'label' => 'Rent',
                'budgeted' => '2000',
            ]));
            $u->categories()->saveMany(factory(Bdgt\Resources\Category::class, 10)->make());
            $u->goals()->saveMany(factory(Bdgt\Resources\Goal::class, 5)->make());
            for ($i = 0; $i < 100; $i++) {
                factory(Bdgt\Resources\Transaction::class)->create([
                    'user_id'     => 1,
                    'account_id'  => rand(1, 5),
                    'category_id' => rand(1, 10),
                    'bill_id'     => rand(1, 5),
                ]);
            }
        });

        factory(Bdgt\Resources\Transaction::class)->create([
            'user_id'     => 1,
            'account_id'  => 1,
            'category_id' => 1,
            'bill_id'     => 1,
        ]);

        factory(Bdgt\Resources\User::class, 3)->create()->each(function ($u) {
            $u->accounts()->saveMany(factory(Bdgt\Resources\Account::class, 5)->make());
            $u->bills()->saveMany(factory(Bdgt\Resources\Bill::class, 5)->make());
            $u->categories()->saveMany(factory(Bdgt\Resources\Category::class, 5)->make());
            $u->goals()->saveMany(factory(Bdgt\Resources\Goal::class, 5)->make());
        });

        for ($i = 0; $i < 100; $i++) {
            factory(Bdgt\Resources\Transaction::class)->create([
                'user_id'     => rand(1, 3),
                'account_id'  => rand(1, 5),
                'category_id' => rand(1, 5),
                'bill_id'     => rand(1, 5),
            ]);
        }
    }
}
