<?php

namespace Tests\Feature\Repositories;

use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Resources\Transaction;
use App\Resources\User;
use Tests\TestCase;

class TransactionRepositoryTest extends TestCase
{
    private $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = app()->make(TransactionRepositoryInterface::class);

        $this->be(factory(User::class)->create());
    }

    /**
     * Test that the repository 'create' method stores its input in the database
     */
    public function testCreateStoresInputToDatabase()
    {
        $transaction = factory(Transaction::class)->states('with_account')->make();

        $createdTransaction = $this->repository->create($transaction->toArray());

        $this->assertEquals($transaction->amount, $createdTransaction->amount);
        $this->assertDatabaseHas('transactions', array_add($transaction->toArray(), 'id', $createdTransaction->id));
    }

    /**
     * Test that the repository 'update' method updates the database with its input
     */
    public function testUpdateChangesInputInDatabase()
    {
        $transaction = factory(Transaction::class)->states('with_account')->create();
        $transactionArray = $transaction->toArray();
        $transactionArray['amount'] = 155.49;

        $updatedTransaction = $this->repository->update($transactionArray, $transaction->id);

        $this->assertEquals($transaction->id, $updatedTransaction->id);
        $this->assertDatabaseHas('transactions', array_add($transactionArray, 'id', $updatedTransaction->id));
    }

    /**
     * Test that the repository 'delete' method deletes the applicable row from the database
     */
    public function testDeleteMethodRemovesRowFromDatabase()
    {
        $transaction = factory(Transaction::class)->states('with_account')->create();

        $this->repository->delete($transaction->id);

        $this->assertDatabaseMissing('transactions', [
            'id' => $transaction->id
        ]);
    }
}
