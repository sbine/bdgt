<?php

namespace Database\Seeders;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Database\Seeder;

class GoalSeeder extends Seeder
{
    public function run()
    {
        User::all()->each(function (User $user) {
            $user->goals()->saveMany(Goal::factory()->count(3)->make());
        });
    }
}
