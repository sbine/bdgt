<?php

class AccountRepositoryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->account = $this->mock('Bdgt\Resources\Account[create,save,update,delete]');
        $this->account->user_id = 'testing';

        $this->repository = $this->app->make('Bdgt\Repositories\Contracts\AccountRepositoryInterface', [$this->account]);
    }

    public function testCreateMethodIsCalled()
    {
        $accountArray = [
            'name' => 'Checking'
        ];

        $this->account->shouldReceive('create')->once()->with($this->addScopeKeyToData($accountArray));

        $this->repository->create($accountArray);
    }

    public function testUpdateMethodIsCalled()
    {
        $accountArray = [
            'name' => 'Checking'
        ];

        $this->account->shouldReceive('where')->once()->andReturn($this->account)->shouldReceive('update')->once()->with($this->addScopeKeyToData($accountArray));

        $this->repository->update($accountArray, 1);
    }

    public function testDeleteMethodIsCalled()
    {
        $id = 3;

        $this->account->shouldReceive('find')->once()->with($id)->andReturn($this->account)->shouldReceive('delete')->once();

        $this->repository->delete($id);
    }

    private function addScopeKeyToData($data)
    {
        $data['user_id'] = 'testing';

        return $data;
    }
}
