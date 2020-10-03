<?php

namespace Tests\Feature;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/** @group goal */
class GoalTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Goal::flushEventListeners();
    }

    /** @test */
    public function index_displays_all_goals()
    {
        $user = User::factory()->create();
        $goals = Goal::factory()->count(3)->create([
            'user_id' => $user->id,
        ]);

        $self = $this->actingAs($user)
            ->get(route('goals.index'))
            ->assertStatus(200);

        $goals->each(function ($goal) use ($self) {
            $self->assertSee(e($goal->label));
        });
    }

    /** @test */
    public function show_displays_associated_goal()
    {
        $goal = Goal::factory()->forUser()->create();

        $this->actingAs($goal->user)
            ->get(route('goals.show', $goal))
            ->assertStatus(200)
            ->assertSee(e($goal->label));
    }

    /** @test */
    public function cannot_view_another_users_goal()
    {
        $goal = Goal::factory()->forUser()->create();

        $this->actingAs(User::factory()->create())
            ->get(route('goals.show', $goal))
            ->assertNotFound();
    }

    /** @test */
    public function store_persists_new_goal_and_redirects()
    {
        $user = User::factory()->create();
        $this->be($user);

        $goal = Goal::factory()->make();

        $this
            ->post(route('goals.store', $goal->toArray()))
            ->assertStatus(302);

        $this->assertEquals($user->id, $goal->user_id);
        $this->assertDatabaseHas('goals', $goal->getAttributes());
    }

    /** @test */
    public function unsuccessful_store_redirects_with_error()
    {
        $this->actingAs(User::factory()->create())
            ->post(route('goals.store', []))
            ->assertStatus(302)
            ->assertSessionHas('errors');
    }

    /** @test */
    public function update_persists_changes_and_redirects()
    {
        $goal = Goal::factory()->forUser()->create();
        $goal->balance = 500;

        $this->actingAs($goal->user)
            ->put(route('goals.update', $goal), $goal->toArray())
            ->assertRedirect(route('goals.show', $goal));

        $this->assertDatabaseHas('goals', $goal->getAttributes());
    }

    /** @test */
    public function cannot_update_another_users_goal()
    {
        $goal = Goal::factory()->forUser()->create();

        $this->actingAs(User::factory()->create())
            ->put(route('goals.update', $goal), [])
            ->assertNotFound();
    }

    /** @test */
    public function delete_deletes_and_redirects_to_index()
    {
        $goal = Goal::factory()->forUser()->create();

        $this->actingAs($goal->user)
            ->delete(route('goals.destroy', $goal))
            ->assertRedirect(route('goals.index'));

        $this->assertDatabaseMissing('goals', ['id' => $goal->id]);
    }

    /** @test */
    public function cannot_delete_another_users_goal()
    {
        $goal = Goal::factory()->forUser()->create();

        $this->actingAs(User::factory()->create())
            ->delete(route('goals.destroy', $goal))
            ->assertNotFound();

        $this->assertDatabaseHas('goals', ['id' => $goal->id]);
    }
}
