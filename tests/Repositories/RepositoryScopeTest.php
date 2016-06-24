<?php

namespace Bdgt\Tests\Repositories;

use Bdgt\Tests\TestCase;
use Mockery;

class RepositoryScopeTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->model = $this->mock('Illuminate\Database\Eloquent\Model[save,delete]');
        $this->repository = Mockery::mock('Bdgt\Repositories\Eloquent\EloquentRepository[instance]', [$this->model]);
        $this->repository->scopeBy('user_id', 'testing');
    }

    public function testCreateMethodIsScoped()
    {
        $data = [];

        $this->repository->shouldReceive('instance')->once()->andReturn($this->model);
        $this->model->shouldReceive('save')->once();

        $this->repository->create($data);

        $this->assertEquals('testing', $this->model->user_id);
    }

    public function testUpdateMethodIsScoped()
    {
        $data = [];

        $this->repository->shouldReceive('instance')->once()->with('id', 1)->andReturn($this->model);
        $this->model->shouldReceive('save')->once();

        $this->repository->update($data, 1);

        $this->assertEquals('testing', $this->model->user_id);
    }

    public function testDeleteMethodIsScoped()
    {
        $id = 3;
        $this->model->user_id = 2;

        $this->repository->shouldReceive('instance')->once()->with('id', $id)->andReturn($this->model);
        $this->model->shouldNotReceive('delete');

        $this->setExpectedException('Exception', 'Invalid scope');

        $this->repository->delete($id);
    }

    private function addScopeKeyToData($data)
    {
        $data['user_id'] = 'testing';

        return $data;
    }
}
