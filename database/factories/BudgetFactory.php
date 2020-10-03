<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetFactory extends Factory
{
    protected $model = Budget::class;

    public function definition($overrides = [])
    {
        $randomDate = $this->faker->dateTimeThisDecade();
        $year = $overrides['year'] ?? $randomDate->format('Y');
        $month = $overrides['month'] ?? $randomDate->format('m');
        $date = Carbon::createFromDate($year, $month);

        $budgeted = $overrides['budgeted'] ?? $this->faker->randomFloat(2, 0, 200);
        $spent = $overrides['spent'] ?? $this->faker->randomFloat(2, 0, $budgeted);

        return [
            'category_id' => Category::factory(),
            'year' => $date->format('Y'),
            'month' => $date->format('n'),
            'budgeted' => $budgeted,
            'spent' => $spent,
            'balance' => round($budgeted - $spent, 2),
        ];
    }
}
