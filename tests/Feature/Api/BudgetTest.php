<?php

namespace Tests\Feature\Api;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/** @group budget */
class BudgetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_list_their_own_budgets()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $budget = factory(Budget::class)->states('with_category')->create();

        $this
            ->get(route('api.budget.index', ['year' => $budget->year, 'month' => $budget->month]))
            ->assertJsonFragment([
                'date' => $budget->date->format('Y-m-d'),
            ]);
    }

    /** @test */
    public function user_can_view_their_own_budget()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $budget = factory(Budget::class)->states('with_category')->create()->load('category');

        $this
            ->get(route('api.budget.show', [
                'year' => $budget->year,
                'month' => $budget->month,
                'category' => $budget->category_id,
            ]))
            ->assertJsonFragment([
                'date' => $budget->date->format('Y-m-d'),
                'category' => $budget->category->label,
            ]);
    }

    /** @test */
    public function user_can_edit_their_own_budget()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $budget = factory(Budget::class)->states('with_category')->create();
        $updatedBudget = factory(Budget::class)->states('with_category')->make()->toArray();

        $this
            ->post(route('api.budget.update', [
                'year' => $budget->year,
                'month' => $budget->month,
                'category' => $budget->category_id,
            ]), $updatedBudget)
            ->assertSessionHasNoErrors()
            ->assertJsonFragment([
                'success' => true,
            ]);

        $this->assertDatabaseHas('budgets', array_merge(
            $updatedBudget,
            [
                'year' => $budget->year,
                'month' => $budget->month,
                'category_id' => $budget->category_id,
                'user_id' => $user->id,
            ]
        ));
    }

    /** @test */
    public function user_can_delete_their_own_budget()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $budget = factory(Budget::class)->states('with_category')->create();

        $this
            ->delete(route('api.budget.destroy', [
                'year' => $budget->year,
                'month' => $budget->month,
                'category' => $budget->category_id,
            ]))
            ->assertSessionHasNoErrors()
            ->assertJsonFragment([
                'success' => true,
            ]);

        $this->assertDatabaseMissing('budgets', $budget->toArray());
    }

    /** @test */
    public function deleting_a_non_existent_budget_doesnt_throw_an_error()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $budget = factory(Budget::class)->states('with_category')->make();

        $this
            ->delete(route('api.budget.destroy', [
                'year' => $budget->year,
                'month' => $budget->month,
                'category' => $budget->category_id,
            ]))
            ->assertSessionHasNoErrors()
            ->assertJsonFragment([
                'success' => true,
            ]);

        $this->assertDatabaseMissing('budgets', $budget->toArray());
    }
}
