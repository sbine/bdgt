<?php

use App\Models\Account;
use App\Models\Bill;
use App\Models\Category;
use App\Models\Goal;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $adminUser = factory(User::class)->create([
            'id'       => 1,
            'username' => 'admin',
            'email'    => 'admin@example.com',
            'password' => Hash::make('admin')
        ]);

        Auth::login($adminUser);
        $adminUser->accounts()->saveMany(factory(Account::class, 5)->make());

        $adminUser->bills()->saveMany(factory(Bill::class, 5)->make());

        $rentCategory = factory(Category::class)->make([
            'label' => 'Rent',
            'budgeted' => '2000',
        ]);
        $adminUser->categories()->save($rentCategory);
        $adminUser->categories()->saveMany(factory(Category::class, 10)->make());

        $adminUser->goals()->saveMany(factory(Goal::class, 5)->make());

        for ($i = 0; $i < 100; $i++) {
            factory(Transaction::class)->create([
                'user_id'     => $adminUser->id,
                'account_id'  => rand(1, 5),
                'category_id' => rand(1, 10),
                'bill_id'     => rand(1, 5),
            ]);
        }

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

        // Seed Rent transactions first as a nice baseline for reports.
        for ($i = 0; $i < 50; $i++) {
            factory(Transaction::class)->create([
                'user_id'     => $adminUser->id,
                'account_id'  => rand(1, 5),
                'category_id' => $rentCategory->id,
                'bill_id'     => rand(1, 5),
                'amount'      => rand(1000, 3000),
                'inflow'      => 0,
            ]);
        }

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
