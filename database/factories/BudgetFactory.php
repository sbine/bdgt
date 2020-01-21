<?php

use App\Models\Budget;
use App\Models\Category;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Budget::class, function (Faker $faker) {
    $date = $faker->dateTimeThisDecade();
    $budgeted = $faker->randomFloat(2, 0, 200);
    $spent = $faker->randomFloat(2, 0, $budgeted);

    return [
        'year' => $date->format('Y'),
        'month' => $date->format('n'),
        'budgeted' => $budgeted,
        'spent' => $spent,
        'balance' => round($budgeted - $spent, 2),
    ];
});

$factory->state(Budget::class, 'with_category', function () {
    return [
        'category_id' => factory(Category::class)->lazy(),
    ];
});

$factory->state(Budget::class, 'with_user', function () {
    return [
        'user_id' => factory(User::class)->lazy(),
    ];
});
