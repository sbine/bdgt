<?php

namespace Tests\Feature\Repositories;

use App\Repositories\Contracts\GoalRepositoryInterface;
use App\Resources\Goal;
use App\Resources\User;
use Tests\TestCase;

class GoalRepositoryTest extends TestCase
{
    private $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = app()->make(GoalRepositoryInterface::class);

        $this->be(factory(User::class)->create());
    }

    /**
     * Test that the repository 'create' method stores its input in the database
     */
    public function testCreateStoresInputToDatabase()
    {
        $goal = factory(Goal::class)->make();

        $createdGoal = $this->repository->create($goal->toArray());

        $this->assertEquals($goal->label, $createdGoal->label);
        $this->assertDatabaseHas('goals', array_add($goal->toArray(), 'id', $createdGoal->id));
    }

    /**
     * Test that the repository 'update' method updates the database with its input
     */
    public function testUpdateChangesInputInDatabase()
    {
        $goal = factory(Goal::class)->create();
        $goalArray = $goal->toArray();
        $goalArray['label'] = 'Acme';

        $updatedGoal = $this->repository->update($goalArray, $goal->id);

        $this->assertEquals($goal->id, $updatedGoal->id);
        $this->assertDatabaseHas('goals', array_add($goalArray, 'id', $updatedGoal->id));
    }

    /**
     * Test that the repository 'delete' method deletes the applicable row from the database
     */
    public function testDeleteMethodRemovesRowFromDatabase()
    {
        $goal = factory(Goal::class)->create();

        $this->repository->delete($goal->id);

        $this->assertDatabaseMissing('goals', [
            'id' => $goal->id
        ]);
    }
}
