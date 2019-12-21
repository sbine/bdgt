<?php

use App\Models\Account;
use App\Models\User;
use App\Providers\FakerProvider;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {
    $faker->addProvider(new FakerProvider($faker));

    return [
        'date_opened' => $faker->dateTimeThisDecade()->format('Y-m-d H:i:s'),
        'name'        => $faker->randomAccount(),
        'balance'     => $faker->randomFloat(2, 0, 10000),
        'interest'    => $faker->numberBetween(0, 20),
    ];
});

$factory->state(Account::class, 'with_user', function () {
    return [
        'user_id' => factory(User::class)->lazy(),
    ];
});
