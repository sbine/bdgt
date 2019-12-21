<?php

use App\Models\Category;
use App\Models\User;
use App\Providers\FakerProvider;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $faker->addProvider(new FakerProvider($faker));

    return [
        'label'    => $faker->randomCategory(),
        'budgeted' => $faker->randomFloat(2, 0, 5000),
    ];
});

$factory->state(Category::class, 'with_user', function () {
    return [
        'user_id' => factory(User::class)->lazy(),
    ];
});
