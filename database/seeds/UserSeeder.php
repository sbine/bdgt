<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        factory(User::class)->create([
            'email' => 'admin@example.com',
            'password' => Hash::make('admin')
        ]);

        factory(User::class, 30)->create();
    }
}
