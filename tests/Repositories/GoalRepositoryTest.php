<?php

class GoalRepositoryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->goal = $this->mock('Bdgt\Resources\Goal[create,save,update,delete]');
        $this->goal->user_id = 'testing';

        $this->repository = $this->app->make('Bdgt\Repositories\Contracts\GoalRepositoryInterface', [$this->goal]);
    }

    public function testCreateMethodIsCalled()
    {
        $goalArray = [
            'label' => 'Retirement'
        ];

        $this->goal->shouldReceive('create')->once()->with($this->addScopeKeyToData($goalArray));

        $this->repository->create($goalArray);
    }

    public function testUpdateMethodIsCalled()
    {
        $goalArray = [
            'label' => 'Retirement'
        ];

        $this->goal->shouldReceive('where')->once()->andReturn($this->goal)->shouldReceive('update')->once()->with($this->addScopeKeyToData($goalArray));

        $this->repository->update($goalArray, 1);
    }

    public function testDeleteMethodIsCalled()
    {
        $id = 3;

        $this->goal->shouldReceive('find')->once()->with($id)->andReturn($this->goal)->shouldReceive('delete')->once();

        $this->repository->delete($id);
    }

    private function addScopeKeyToData($data)
    {
        $data['user_id'] = 'testing';

        return $data;
    }
}
