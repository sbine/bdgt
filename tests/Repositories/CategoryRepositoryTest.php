<?php

namespace Bdgt\Tests\Repositories;

use Bdgt\Tests\TestCase;
use Mockery;

class CategoryRepositoryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->category = $this->mock('Bdgt\Resources\Category[save,delete]');
        $this->repository = Mockery::mock('Bdgt\Repositories\Eloquent\EloquentCategoryRepository[instance]', [$this->category]);
        $this->repository->scopeBy('user_id', 'testing');
    }

    /**
     * Test that the repository 'create' method sets attributes and saves a model
     */
    public function testCreateMethodIsCalled()
    {
        $categoryArray = [
            'label' => 'Emergency Fund'
        ];

        $this->repository->shouldReceive('instance')->once()->andReturn($this->category);
        $this->category->shouldReceive('save')->once();

        $this->repository->create($categoryArray);

        $this->assertEquals('Emergency Fund', $this->category->label);
    }

    /**
     * Test that the repository 'update' method changes attributes and saves a model
     */
    public function testUpdateMethodIsCalled()
    {
        $categoryArray = [
            'label' => 'Emergency Fund'
        ];

        $this->repository->shouldReceive('instance')->once()->with('id', 1)->andReturn($this->category);
        $this->category->shouldReceive('save')->once();

        $this->repository->update($categoryArray, 1);

        $this->assertEquals('Emergency Fund', $this->category->label);
    }

    /**
     * Test that the repository 'delete' method deletes a model
     */
    public function testDeleteMethodIsCalled()
    {
        $id = 3;

        $this->repository->shouldReceive('instance')->once()->with('id', $id)->andReturn($this->category);
        $this->category->shouldReceive('delete')->once();

        $this->repository->delete($id);
    }

    private function addScopeKeyToData($data)
    {
        $data['user_id'] = 'testing';

        return $data;
    }
}
