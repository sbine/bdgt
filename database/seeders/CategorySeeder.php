<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        User::all()->each(function (User $user) {
            $user->categories()->saveMany(Category::factory()->count(5)->make());
        });
    }
}
