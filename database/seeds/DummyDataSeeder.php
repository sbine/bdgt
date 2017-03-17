<?php

use Bdgt\Resources\Account;
use Bdgt\Resources\Bill;
use Bdgt\Resources\Category;
use Bdgt\Resources\Goal;
use Bdgt\Resources\Transaction;
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
        // TODO: find a better way to do this
        Account::flushEventListeners();
        Bill::flushEventListeners();
        Category::flushEventListeners();
        Goal::flushEventListeners();
        Transaction::flushEventListeners();

        factory(Bdgt\Resources\User::class)->create([
            'id'       => 1,
            'username' => 'admin',
            'email'    => 'admin@example.com',
            'password' => Hash::make('admin')
        ])->each(function ($u) {
            $u->accounts()->saveMany(factory(Account::class, 5)->make());
            $u->bills()->saveMany(factory(Bill::class, 5)->make());
            $u->categories()->save(factory(Category::class)->make([
                'label' => 'Rent',
                'budgeted' => '2000',
            ]));
            $u->categories()->saveMany(factory(Category::class, 10)->make());
            $u->goals()->saveMany(factory(Goal::class, 5)->make());
            for ($i = 0; $i < 100; $i++) {
                factory(Transaction::class)->create([
                    'user_id'     => 1,
                    'account_id'  => rand(1, 5),
                    'category_id' => rand(1, 10),
                    'bill_id'     => rand(1, 5),
                ]);
            }
        });

        factory(Transaction::class)->create([
            'user_id'     => 1,
            'account_id'  => 1,
            'category_id' => 1,
            'bill_id'     => 1,
        ]);

        factory(User::class, 3)->create()->each(function ($u) {
            $u->accounts()->saveMany(factory(Account::class, 5)->make());
            $u->bills()->saveMany(factory(Bill::class, 5)->make());
            $u->categories()->saveMany(factory(Category::class, 5)->make());
            $u->goals()->saveMany(factory(Goal::class, 5)->make());
        });

        for ($i = 0; $i < 100; $i++) {
            factory(Transaction::class)->create([
                'user_id'     => rand(1, 3),
                'account_id'  => rand(1, 5),
                'category_id' => rand(1, 5),
                'bill_id'     => rand(1, 5),
            ]);
        }
    }
}
