<?php

namespace Bdgt\Tests\Repositories;

use Bdgt\Tests\TestCase;
use Mockery;

class GoalRepositoryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->goal = $this->mock('Bdgt\Resources\Goal[save,delete]');
        $this->repository = Mockery::mock('Bdgt\Repositories\Eloquent\EloquentGoalRepository[instance]', [$this->goal]);
    }

    /**
     * Test that the repository 'create' method sets attributes and saves a model
     */
    public function testCreateMethodIsCalled()
    {
        $goalArray = [
            'label' => 'Retirement'
        ];

        $this->repository->shouldReceive('instance')->once()->andReturn($this->goal);
        $this->goal->shouldReceive('save')->once();

        $this->repository->create($goalArray);

        $this->assertEquals('Retirement', $this->goal->label);
    }

    /**
     * Test that the repository 'update' method changes attributes and saves a model
     */
    public function testUpdateMethodIsCalled()
    {
        $goalArray = [
            'label' => 'Retirement'
        ];

        $this->repository->shouldReceive('instance')->once()->with('id', 1)->andReturn($this->goal);
        $this->goal->shouldReceive('save')->once();

        $this->repository->update($goalArray, 1);

        $this->assertEquals('Retirement', $this->goal->label);
    }

    /**
     * Test that the repository 'delete' method deletes a model
     */
    public function testDeleteMethodIsCalled()
    {
        $id = 3;

        $this->repository->shouldReceive('instance')->once()->with('id', $id)->andReturn($this->goal);
        $this->goal->shouldReceive('delete')->once();

        $this->repository->delete($id);
    }
}
