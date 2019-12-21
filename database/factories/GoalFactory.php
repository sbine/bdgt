<?php

use App\Models\Goal;
use App\Models\User;
use App\Providers\FakerProvider;
use Faker\Generator as Faker;

$factory->define(Goal::class, function (Faker $faker) {
    $faker->addProvider(new FakerProvider($faker));
    $amount = $faker->randomFloat(2, 0, 200);

    return [
        'label'      => $faker->randomGoal(),
        'start_date' => $faker->dateTimeThisDecade()->format('Y-m-d'),
        'goal_date'  => $faker->dateTimeBetween('now', '+10 years')->format('Y-m-d'),
        'balance'    => $faker->randomFloat(2, 0, $amount),
        'amount'     => $amount,
    ];
});

$factory->state(Goal::class, 'with_user', function () {
    return [
        'user_id' => factory(User::class)->lazy(),
    ];
});
