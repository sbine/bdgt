<?php

use App\Models\Budget;
use App\Models\User;
use Illuminate\Database\Seeder;

class BudgetSeeder extends Seeder
{
    public function run()
    {
        User::with('categories')->get()->each(function (User $user) {
            $user->budgets()->saveMany(
                factory(Budget::class, 5)->make([
                    'category_id' => function () use ($user) {
                        return $user->categories->random()->first()->id;
                    },
                ])
            );
        });
    }
}
