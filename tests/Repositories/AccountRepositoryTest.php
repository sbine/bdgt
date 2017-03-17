<?php

namespace Bdgt\Tests\Repositories;

use Bdgt\Repositories\Contracts\AccountRepositoryInterface;
use Bdgt\Resources\Account;
use Bdgt\Resources\User;
use Bdgt\Tests\TestCase;

class AccountRepositoryTest extends TestCase
{
    private $repository;

    public function setUp()
    {
        parent::setUp();

        $this->repository = app()->make(AccountRepositoryInterface::class);

        $this->be(factory(User::class)->create());
    }

    /**
     * Test that the repository 'create' method stores its input in the database
     */
    public function testCreateStoresInputToDatabase()
    {
        $account = factory(Account::class)->make();

        $createdAccount = $this->repository->create($account->toArray());

        $this->assertEquals($account->name, $createdAccount->name);
        $this->assertDatabaseHas('accounts', array_add($account->toArray(), 'id', $createdAccount->id));
    }

    /**
     * Test that the repository 'update' method updates the database with its input
     */
    public function testUpdateChangesInputInDatabase()
    {
        $account = factory(Account::class)->create();
        $accountArray = $account->toArray();
        $accountArray['name'] = 'Acme';

        $updatedAccount = $this->repository->update($accountArray, $account->id);

        $this->assertEquals($account->id, $updatedAccount->id);
        $this->assertDatabaseHas('accounts', array_add($accountArray, 'id', $updatedAccount->id));
    }

    /**
     * Test that the repository 'delete' method deletes the applicable row from the database
     */
    public function testDeleteMethodRemovesRowFromDatabase()
    {
        $account = factory(Account::class)->create();

        $this->repository->delete($account->id);

        $this->assertDatabaseMissing('accounts', [
            'id' => $account->id
        ]);
    }
}
