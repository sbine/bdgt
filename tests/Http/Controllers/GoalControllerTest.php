<?php

namespace Bdgt\Tests\Http\Controllers;

use Bdgt\Http\Controllers\GoalController;
use Bdgt\Resources\Goal;
use Bdgt\Resources\User;
use Bdgt\Tests\TestCase;

class GoalControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        Goal::flushEventListeners();
    }

    public function testIndexDisplaysAllGoals()
    {
        $user = factory(User::class)->create();
        $goals = factory(Goal::class, 3)->create([
            'user_id' => $user->id
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

    public function testShowWithInvalidIdRedirectsToIndex()
    {
        $this->actingAs(factory(User::class)->create())
            ->get(route('goals.show', [ 'goal' => -1 ]))
            ->assertRedirect(route('goals.index'));
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
            ->assertSessionHas('alerts.danger');
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

    public function testUnsuccessfulUpdateRedirectsWithError()
    {
        $this->actingAs(factory(User::class)->create())
            ->put(route('goals.update', [ 'goal' => -1 ]), [])
            ->assertStatus(302)
            ->assertSessionHas('alerts.danger');
    }

    public function testDeleteDeletesAndRedirectsToIndex()
    {
        $goal = factory(Goal::class)->states('with_user')->create();

        $this->actingAs($goal->user)
            ->delete(route('goals.destroy', $goal->id))
            ->assertRedirect(route('goals.index'));

        $this->assertDatabaseMissing('goals', [ 'id' => $goal->id ]);
    }

    public function testUnsuccessfulDeleteRedirectsWithError()
    {
        $this->actingAs(factory(User::class)->create())
            ->delete(route('goals.destroy', -1))
            ->assertStatus(302)
            ->assertSessionHas('alerts.danger');
    }
}
