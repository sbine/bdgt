<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    public function run()
    {
        User::all()->each(function (User $user) {
            $user->accounts()->saveMany(Account::factory()->count(3)->make());
        });
    }
}
