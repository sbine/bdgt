<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BudgetResource;
use App\Models\Budget;
use App\Models\Category;

class BudgetController extends Controller
{
    public function index(string $year, string $month)
    {
        $budgets = collect([]);

        Category::all()->each(function ($category) use ($budgets, $year, $month) {
            $budgets->push(Budget::firstOrNew([
                'year' => $year,
                'month' => $month,
                'category_id' => $category->id,
            ])->load('category'));
        });

        return BudgetResource::collection($budgets);
    }

    public function show(string $year, string $month, Category $category)
    {
        $this->authorize('view', $category);

        $budget = Budget::firstOrNew([
            'year' => $year,
            'month' => $month,
            'category_id' => $category->id,
        ]);

        $this->authorize('view', $budget);

        return new BudgetResource($budget->load('category'));
    }

    public function update(string $year, string $month, Category $category)
    {
        $this->authorize('view', $category);

        $budget = Budget::with('category')->firstOrCreate([
            'year' => $year,
            'month' => $month,
            'category_id' => $category->id,
        ]);

        $this->authorize('update', $budget);

        $budget->fill(request()->only([
            'budgeted',
            'spent',
            'balance',
        ]));

        return response()->json([
            'success' => $budget->save(),
            'data' => new BudgetResource($budget->load('category')),
        ]);
    }

    public function destroy(string $year, string $month, Category $category)
    {
        $budget = Budget::firstOrNew([
            'year' => $year,
            'month' => $month,
            'category_id' => $category->id,
        ]);

        $this->authorize('delete', $budget);

        $budget->delete();

        return response()->json([
            'success' => ! $budget->exists(),
        ]);
    }
}
