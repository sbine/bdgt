<?php

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        User::with(['accounts', 'categories', 'bills'])->get()->each(function (User $user) {
            $user->transactions()->saveMany(
                factory(Transaction::class, 30)->make([
                    'account_id' => function () use ($user) {
                        return $user->accounts->random()->first();
                    },
                    'category_id' => function () use ($user) {
                        return $user->categories->random()->first();
                    },
                    'bill_id' => function () use ($user) {
                        return $user->bills->random()->first();
                    },
                ])
            );
        });
    }
}
