<?php

class TransactionRepositoryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->transaction = $this->mock('Bdgt\Resources\Transaction[create,save,update,delete]');
        $this->transaction->user_id = 'testing';

        $this->repository = $this->app->make('Bdgt\Repositories\Contracts\TransactionRepositoryInterface', [$this->transaction]);
    }

    public function testCreateMethodIsCalled()
    {
        $transactionArray = [
            'amount' => '50'
        ];

        $this->transaction->shouldReceive('create')->once()->with($this->addScopeKeyToData($transactionArray));

        $this->repository->create($transactionArray);
    }

    public function testUpdateMethodIsCalled()
    {
        $transactionArray = [
            'amount' => '50'
        ];

        $this->transaction->shouldReceive('where')->once()->andReturn($this->transaction)->shouldReceive('update')->once()->with($this->addScopeKeyToData($transactionArray));

        $this->repository->update($transactionArray, 1);
    }

    public function testDeleteMethodIsCalled()
    {
        $id = 3;

        $this->transaction->shouldReceive('find')->once()->with($id)->andReturn($this->transaction)->shouldReceive('delete')->once();

        $this->repository->delete($id);
    }

    private function addScopeKeyToData($data)
    {
        $data['user_id'] = 'testing';

        return $data;
    }
}
