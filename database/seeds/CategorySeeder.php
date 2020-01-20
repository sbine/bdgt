<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        User::all()->each(function (User $user) {
            $user->categories()->saveMany(factory(Category::class, 5)->make());
        });
    }
}
