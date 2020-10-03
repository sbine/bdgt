<?php

namespace Tests\Feature;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/** @group budget */
class BudgetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_view_their_budget()
    {
        $user = User::factory()->create();
        $this->be($user);

        $budgets = Budget::factory()->count(3)->create([
            'user_id' => $user->id,
        ]);

        $self = $this
            ->get(route('budget'))
            ->assertStatus(200);

        $budgets->each(function ($budget) use ($self) {
            $self->assertSee(e($budget->category->name));
            $self->assertSee(e($budget->spent));
        });
    }
}
