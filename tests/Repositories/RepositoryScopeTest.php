<?php

class RepositoryScopeTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->model = $this->mock('Illuminate\Database\Eloquent\Model');

        $this->repository = $this->getMockForAbstractClass('Bdgt\Repositories\Eloquent\EloquentRepository', [$this->model]);

        $this->repository->scopeBy('user_id', 'testing');
    }

    public function testCreateMethodIsScoped()
    {
        $data = [];

        $this->model->shouldReceive('create')->once()->with($this->addScopeKeyToData($data));

        $this->repository->create($data);
    }

    public function testUpdateMethodIsScoped()
    {
        $data = [];

        $this->model->shouldReceive('where')->once()->andReturn($this->model)->shouldReceive('update')->once()->with($this->addScopeKeyToData($data));

        $this->repository->update($data, 1);
    }

    public function testDeleteMethodIsScoped()
    {
        $id = 3;

        $this->model->shouldReceive('find')->once()->with($id)->andReturn($this->model)->shouldReceive('offsetGet')->once()->andReturn(1)->shouldReceive('getAttribute')->twice();

        $this->setExpectedException('Exception', 'Invalid scope');

        $this->repository->delete($id);
    }

    private function addScopeKeyToData($data)
    {
        $data['user_id'] = 'testing';

        return $data;
    }
}
