<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        User::with(['accounts', 'categories', 'bills'])->get()->each(function (User $user) {
            Transaction::insert(
                Transaction::factory()->count(30)->make([
                    'user_id' => $user->id,
                    'account_id' => function () use ($user) {
                        return $user->accounts->random();
                    },
                    'category_id' => function () use ($user) {
                        return $user->categories->random();
                    },
                    'bill_id' => function () use ($user) {
                        return $user->bills->random();
                    },
                ])->toArray()
            );
        });
    }
}
