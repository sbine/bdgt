<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Bdgt\Resources\User::class, function (Faker\Generator $faker) {
    return [
        'username'       => $faker->userName,
        'email'          => $faker->safeEmail,
        'password'       => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Bdgt\Resources\Account::class, function (Faker\Generator $faker) {
    return [
        'date_opened' => $faker->dateTimeThisDecade()->format('Y-m-d'),
        'name'        => $faker->creditCardType(),
        'balance'     => $faker->randomFloat(2, 0, 100000),
        'interest'    => $faker->numberBetween(0, 20),
    ];
});

$factory->define(Bdgt\Resources\Bill::class, function (Faker\Generator $faker) {
    return [
        'start_date' => $faker->dateTimeThisDecade()->format('Y-m-d'),
        'frequency'  => $faker->randomDigitNotNull(),
        'label'      => $faker->words(2, true),
        'amount'     => $faker->randomFloat(2, 0, 2000),
    ];
});

$factory->define(Bdgt\Resources\Category::class, function (Faker\Generator $faker) {
    $faker->addProvider(new \Bdgt\Providers\FakerProvider($faker));
    return [
        'label'    => $faker->randomCategory(),
        'budgeted' => $faker->randomFloat(2, 0, 5000),
    ];
});

$factory->define(Bdgt\Resources\Goal::class, function (Faker\Generator $faker) {
    $amount = $faker->randomFloat(2, 0, 200);
    return [
        'label'      => $faker->words(2, true),
        'start_date' => $faker->dateTimeThisDecade()->format('Y-m-d'),
        'goal_date'  => $faker->dateTimeBetween('now', '+10 years')->format('Y-m-d'),
        'balance'    => $faker->randomFloat(2, 0, $amount),
        'amount'     => $amount,
    ];
});

$factory->define(Bdgt\Resources\Transaction::class, function (Faker\Generator $faker) {

    return [
        'date'    => $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
        'payee'   => $faker->name,
        'amount'  => (2000 - $faker->biasedNumberBetween(1, 2000)) . '.' . $faker->numberBetween(0, 100),
        'inflow'  => $faker->boolean(),
        'cleared' => $faker->boolean(),
        'flair'   => $faker->randomFlair(),
    ];
});
