<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
        ]);

        User::factory()->count(3)->create();
    }
}
