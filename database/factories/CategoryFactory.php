<?php

namespace Database\Factories;

use App\Models\Category;
use App\Providers\FakerProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        $this->faker->addProvider(new FakerProvider($this->faker));

        return [
            'label' => $this->faker->randomCategory(),
            'budgeted' => $this->faker->randomFloat(2, 0, 5000),
        ];
    }
}
