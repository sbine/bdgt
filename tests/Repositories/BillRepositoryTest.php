<?php

namespace Bdgt\Tests\Repositories;

use Bdgt\Repositories\Contracts\BillRepositoryInterface;
use Bdgt\Resources\Bill;
use Bdgt\Resources\User;
use Bdgt\Tests\TestCase;

class BillRepositoryTest extends TestCase
{
    private $repository;

    public function setUp()
    {
        parent::setUp();

        $this->repository = app()->make(BillRepositoryInterface::class);

        $this->be(factory(User::class)->create());
    }

    /**
     * Test that the repository 'create' method stores its input in the database
     */
    public function testCreateStoresInputToDatabase()
    {
        $bill = factory(Bill::class)->make();

        $createdBill = $this->repository->create($bill->toArray());

        $this->assertEquals($bill->label, $createdBill->label);
        $this->assertDatabaseHas('bills', array_add($bill->toArray(), 'id', $createdBill->id));
    }

    /**
     * Test that the repository 'update' method updates the database with its input
     */
    public function testUpdateChangesInputInDatabase()
    {
        $bill = factory(Bill::class)->create();
        $billArray = $bill->toArray();
        $billArray['label'] = 'Acme';

        $updatedBill = $this->repository->update($billArray, $bill->id);

        $this->assertEquals($bill->id, $updatedBill->id);
        $this->assertDatabaseHas('bills', array_add($billArray, 'id', $updatedBill->id));
    }

    /**
     * Test that the repository 'delete' method deletes the applicable row from the database
     */
    public function testDeleteMethodRemovesRowFromDatabase()
    {
        $bill = factory(Bill::class)->create();

        $this->repository->delete($bill->id);

        $this->assertDatabaseMissing('bills', [
            'id' => $bill->id
        ]);
    }
}
