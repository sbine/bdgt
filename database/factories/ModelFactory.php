<?php

use Bdgt\Providers\FakerProvider;
use Bdgt\Resources\Account;
use Bdgt\Resources\Bill;
use Bdgt\Resources\Category;
use Bdgt\Resources\Goal;
use Bdgt\Resources\Transaction;
use Bdgt\Resources\User;
use Faker\Generator;

$factory->define(User::class, function (Generator $faker) {
    return [
        'username'       => $faker->userName(),
        'email'          => $faker->safeEmail(),
        'password'       => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Account::class, function (Generator $faker) {
    $faker->addProvider(new FakerProvider($faker));
    return [
        'date_opened' => $faker->dateTimeThisDecade()->format('Y-m-d H:i:s'),
        'name'        => $faker->randomAccount(),
        'balance'     => $faker->randomFloat(2, 0, 10000),
        'interest'    => $faker->numberBetween(0, 20),
    ];
});
$factory->state(Account::class, 'with_user', function (Generator $faker) {
    return [
        'user_id' => function() {
            return factory(User::class)->create()->id;
        }
    ];
});

$factory->define(Bill::class, function (Generator $faker) {
    $faker->addProvider(new FakerProvider($faker));
    return [
        'start_date' => $faker->dateTimeThisDecade()->format('Y-m-d'),
        'frequency'  => $faker->numberBetween(28, 60),
        'label'      => $faker->randomBill(),
        'amount'     => $faker->randomAmount(1200),
    ];
});
$factory->state(Bill::class, 'with_user', function (Generator $faker) {
    return [
        'user_id' => function() {
            return factory(User::class)->create()->id;
        }
    ];
});

$factory->define(Category::class, function (Generator $faker) {
    $faker->addProvider(new FakerProvider($faker));
    return [
        'label'    => $faker->randomCategory(),
        'budgeted' => $faker->randomFloat(2, 0, 5000),
    ];
});
$factory->state(Category::class, 'with_user', function (Generator $faker) {
    return [
        'user_id' => function() {
            return factory(User::class)->create()->id;
        }
    ];
});

$factory->define(Goal::class, function (Generator $faker) {
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
$factory->state(Goal::class, 'with_user', function (Generator $faker) {
    return [
        'user_id' => function() {
            return factory(User::class)->create()->id;
        }
    ];
});

$factory->define(Transaction::class, function (Generator $faker) {
    $faker->addProvider(new FakerProvider($faker));
    $isInflow = $faker->optional(0.3, 0)->boolean();
    return [
        'date'    => $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d H:i:s'),
        'payee'   => $faker->name,
        'amount'  => ($isInflow ? $faker->biasedNumberBetween(50, 2000, function($x) { return cos($x); }) : $faker->randomAmount(2000)),
        'inflow'  => $isInflow,
        'cleared' => $faker->boolean(),
        'flair'   => $faker->randomFlair(),
    ];
});
$factory->state(Transaction::class, 'with_user', function (Generator $faker) {
    return [
        'user_id' => function() {
            return factory(User::class)->create()->id;
        }
    ];
});

$factory->state(Transaction::class, 'with_account', function (Generator $faker) {
    $account = factory(Account::class)->states('with_user')->create();
    return [
        'account_id' => $account->id,
        'user_id' => $account->user->id,
    ];
});
