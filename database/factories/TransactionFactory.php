<?php

use App\Models\Account;
use App\Models\Transaction;
use App\Providers\FakerProvider;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    $faker->addProvider(new FakerProvider($faker));
    $isInflow = $faker->optional(0.3, 0)->boolean();

    return [
        'date'    => $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d H:i:s'),
        'payee'   => $faker->name,
        'amount'  => ($isInflow ? $faker->biasedNumberBetween(50, 3000, function ($x) { return cos($x); }) : $faker->randomAmount(3000)),
        'inflow'  => $isInflow,
        'cleared' => $faker->boolean(),
        'flair'   => $faker->randomFlair(),
    ];
});

$factory->state(Transaction::class, 'with_account', function () {
    $account = factory(Account::class)->states('with_user')->create();

    return [
        'account_id' => $account->id,
        'user_id' => $account->user->id,
    ];
});
