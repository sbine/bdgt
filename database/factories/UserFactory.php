<?php

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'email'          => $faker->unique()->safeEmail(),
        'password'       => bcrypt(Str::random(10)),
        'remember_token' => Str::random(10),
    ];
});
