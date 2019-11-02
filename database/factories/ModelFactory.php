<?php

use App\Providers\FakerProvider;
use App\Resources\Account;
use App\Resources\Bill;
use App\Resources\Category;
use App\Resources\Goal;
use App\Resources\Transaction;
use App\Resources\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'username'       => $faker->userName(),
        'email'          => $faker->unique()->safeEmail(),
        'password'       => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Account::class, function (Faker $faker) {
    $faker->addProvider(new FakerProvider($faker));
    return [
        'date_opened' => $faker->dateTimeThisDecade()->format('Y-m-d H:i:s'),
        'name'        => $faker->randomAccount(),
        'balance'     => $faker->randomFloat(2, 0, 10000),
        'interest'    => $faker->numberBetween(0, 20),
    ];
});
$factory->state(Account::class, 'with_user', function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->lazy(),
    ];
});

$factory->define(Bill::class, function (Faker $faker) {
    $faker->addProvider(new FakerProvider($faker));
    return [
        'start_date' => $faker->dateTimeThisDecade()->format('Y-m-d'),
        'frequency'  => $faker->numberBetween(28, 60),
        'label'      => $faker->randomBill(),
        'amount'     => $faker->randomAmount(1200),
    ];
});
$factory->state(Bill::class, 'with_user', function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->lazy(),
    ];
});

$factory->define(Category::class, function (Faker $faker) {
    $faker->addProvider(new FakerProvider($faker));
    return [
        'label'    => $faker->randomCategory(),
        'budgeted' => $faker->randomFloat(2, 0, 5000),
    ];
});
$factory->state(Category::class, 'with_user', function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->lazy(),
    ];
});

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
$factory->state(Goal::class, 'with_user', function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->lazy(),
    ];
});

$factory->define(Transaction::class, function (Faker $faker) {
    $faker->addProvider(new FakerProvider($faker));
    $isInflow = $faker->optional(0.3, 0)->boolean();
    return [
        'date'    => $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d H:i:s'),
        'payee'   => $faker->name,
        'amount'  => ($isInflow ? $faker->biasedNumberBetween(50, 3000, function($x) { return cos($x); }) : $faker->randomAmount(3000)),
        'inflow'  => $isInflow,
        'cleared' => $faker->boolean(),
        'flair'   => $faker->randomFlair(),
    ];
});
$factory->state(Transaction::class, 'with_user', function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->lazy(),
    ];
});

$factory->state(Transaction::class, 'with_account', function (Faker $faker) {
    $account = factory(Account::class)->states('with_user')->create();
    return [
        'account_id' => $account->id,
        'user_id' => $account->user->id,
    ];
});
