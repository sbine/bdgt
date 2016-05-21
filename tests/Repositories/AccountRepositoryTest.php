<?php

class AccountRepositoryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->account = $this->mock('Bdgt\Resources\Account[save,delete]');
        $this->repository = Mockery::mock('Bdgt\Repositories\Eloquent\EloquentAccountRepository[instance]', [$this->account]);
        $this->repository->scopeBy('user_id', 'testing');
    }

    /**
     * Test that the repository 'create' method sets attributes and saves a model
     */
    public function testCreateMethodIsCalled()
    {
        $accountArray = [
            'name' => 'Checking'
        ];

        $this->repository->shouldReceive('instance')->once()->andReturn($this->account);
        $this->account->shouldReceive('save')->once();

        $this->repository->create($accountArray);

        $this->assertEquals('Checking', $this->account->name);
    }

    /**
     * Test that the repository 'update' method changes attributes and saves a model
     */
    public function testUpdateMethodIsCalled()
    {
        $accountArray = [
            'name' => 'Checking'
        ];

        $this->repository->shouldReceive('instance')->once()->with('id', 1)->andReturn($this->account);
        $this->account->shouldReceive('save')->once();

        $this->repository->update($accountArray, 1);

        $this->assertEquals('Checking', $this->account->name);
    }

    /**
     * Test that the repository 'delete' method deletes a model
     */
    public function testDeleteMethodIsCalled()
    {
        $id = 3;

        $this->repository->shouldReceive('instance')->once()->with('id', $id)->andReturn($this->account);
        $this->account->shouldReceive('delete')->once();

        $this->repository->delete($id);
    }

    private function addScopeKeyToData($data)
    {
        $data['user_id'] = 'testing';

        return $data;
    }
}
