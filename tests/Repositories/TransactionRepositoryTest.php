<?php

namespace Bdgt\Tests\Repositories;

use Bdgt\Tests\TestCase;
use Mockery;

class TransactionRepositoryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->transaction = $this->mock('Bdgt\Resources\Transaction[save,delete]');
        $this->repository = Mockery::mock('Bdgt\Repositories\Eloquent\EloquentTransactionRepository[instance]', [$this->transaction]);
        $this->repository->scopeBy('user_id', 'testing');
    }

    /**
     * Test that the repository 'create' method sets attributes and saves a model
     */
    public function testCreateMethodIsCalled()
    {
        $transactionArray = [
            'amount' => 50
        ];

        $this->repository->shouldReceive('instance')->once()->andReturn($this->transaction);
        $this->transaction->shouldReceive('save')->once();

        $this->repository->create($transactionArray);

        $this->assertEquals(50, $this->transaction->amount);
    }

    /**
     * Test that the repository 'update' method changes attributes and saves a model
     */
    public function testUpdateMethodIsCalled()
    {
        $transactionArray = [
            'amount' => 50
        ];

        $this->repository->shouldReceive('instance')->once()->with('id', 1)->andReturn($this->transaction);
        $this->transaction->shouldReceive('save')->once();

        $this->repository->update($transactionArray, 1);

        $this->assertEquals(50, $this->transaction->amount);
    }

    /**
     * Test that the repository 'delete' method deletes a model
     */
    public function testDeleteMethodIsCalled()
    {
        $id = 3;

        $this->repository->shouldReceive('instance')->once()->with('id', $id)->andReturn($this->transaction);
        $this->transaction->shouldReceive('delete')->once();

        $this->repository->delete($id);
    }

    private function addScopeKeyToData($data)
    {
        $data['user_id'] = 'testing';

        return $data;
    }
}
