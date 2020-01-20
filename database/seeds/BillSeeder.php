<?php

use App\Models\Bill;
use App\Models\User;
use Illuminate\Database\Seeder;

class BillSeeder extends Seeder
{
    public function run()
    {
        User::all()->each(function (User $user) {
            $user->bills()->saveMany(factory(Bill::class, 5)->make());
        });
    }
}
