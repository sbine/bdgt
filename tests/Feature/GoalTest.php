<?php

namespace Tests\Feature;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GoalTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Goal::flushEventListeners();
    }

    public function testIndexDisplaysAllGoals()
    {
        $user = factory(User::class)->create();
        $goals = factory(Goal::class, 3)->create([
            'user_id' => $user->id,
        ]);

        $self = $this->actingAs($user)
            ->get(route('goals.index'))
            ->assertStatus(200);

        $goals->each(function ($goal) use ($self) {
            $self->assertSee(htmlentities($goal->label));
        });
    }

    public function testShowDisplaysAssociatedGoal()
    {
        $goal = factory(Goal::class)->states('with_user')->create();

        $this->actingAs($goal->user)
            ->get(route('goals.show', [ 'goal' => $goal->id ]))
            ->assertStatus(200)
            ->assertSee(htmlentities($goal->label));
    }

    public function testCannotViewAnotherUsersGoal()
    {
        $goal = factory(Goal::class)->states('with_user')->create();

        $this->actingAs(factory(User::class)->create())
            ->get(route('goals.show', [ 'goal' => $goal->id ]))
            ->assertNotFound();
    }

    public function testStorePersistsNewGoalAndRedirects()
    {
        $goal = factory(Goal::class)->make();

        $this->actingAs(factory(User::class)->create())
            ->post(route('goals.store', $goal->toArray()))
            ->assertStatus(302);

        $this->assertDatabaseHas('goals', $goal->toArray());
    }

    public function testUnsuccessfulStoreRedirectsWithError()
    {
        $this->actingAs(factory(User::class)->create())
            ->post(route('goals.store', []))
            ->assertStatus(302)
            ->assertSessionHas('errors');
    }

    public function testUpdatePersistsChangesAndRedirects()
    {
        $goal = factory(Goal::class)->states('with_user')->create();
        $goal->balance = 500;

        $this->actingAs($goal->user)
            ->put(route('goals.update', [ 'goal' => $goal->id ]), $goal->toArray())
            ->assertRedirect(route('goals.show', [ 'goal' => $goal->id ]));

        $this->assertDatabaseHas('goals', $goal->toArray());
    }

    public function testCannotUpdateAnotherUsersGoal()
    {
        $goal = factory(Goal::class)->states('with_user')->create();

        $this->actingAs(factory(User::class)->create())
            ->put(route('goals.update', [ 'goal' => $goal->id ]), [])
            ->assertNotFound();
    }

    public function testDeleteDeletesAndRedirectsToIndex()
    {
        $goal = factory(Goal::class)->states('with_user')->create();

        $this->actingAs($goal->user)
            ->delete(route('goals.destroy', $goal->id))
            ->assertRedirect(route('goals.index'));

        $this->assertDatabaseMissing('goals', [ 'id' => $goal->id ]);
    }

    public function testCannotDeleteAnotherUsersGoal()
    {
        $goal = factory(Goal::class)->states('with_user')->create();

        $this->actingAs(factory(User::class)->create())
            ->delete(route('goals.destroy', $goal->id))
            ->assertNotFound();
    }
}
