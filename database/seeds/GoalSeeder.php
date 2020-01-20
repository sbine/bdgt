<?php

use App\Models\Goal;
use App\Models\User;
use Illuminate\Database\Seeder;

class GoalSeeder extends Seeder
{
    public function run()
    {
        User::all()->each(function (User $user) {
            $user->goals()->saveMany(factory(Goal::class, 5)->make());
        });
    }
}
