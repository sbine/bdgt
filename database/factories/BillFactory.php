<?php

use App\Models\Bill;
use App\Models\User;
use App\Providers\FakerProvider;
use Faker\Generator as Faker;

$factory->define(Bill::class, function (Faker $faker) {
    $faker->addProvider(new FakerProvider($faker));

    return [
        'start_date' => $faker->dateTimeThisDecade()->format('Y-m-d'),
        'frequency'  => $faker->numberBetween(28, 60),
        'label'      => $faker->randomBill(),
        'amount'     => $faker->randomAmount(1200),
    ];
});

$factory->state(Bill::class, 'with_user', function () {
    return [
        'user_id' => factory(User::class)->lazy(),
    ];
});
