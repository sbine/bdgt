<?php

namespace Bdgt\Tests\Http\Controllers;

use Bdgt\Http\Controllers\TransactionController;
use Bdgt\Resources\Account;
use Bdgt\Resources\Transaction;
use Bdgt\Resources\User;
use Bdgt\Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        Transaction::flushEventListeners();
        Account::flushEventListeners();
    }

    public function testIndexDisplaysAllTransactions()
    {
        $account = factory(Account::class)->states('with_user')->create();
        $transactions = factory(Transaction::class, 3)->create([
            'user_id' => $account->user->id,
            'account_id' => $account->id
        ]);

        $self = $this->actingAs($account->user)
            ->get(route('transactions.index'))
            ->assertStatus(200);

        $transactions->each(function ($transaction) use ($self) {
            $self->assertSee(htmlentities($transaction->payee));
        });
    }

    public function testShowDisplaysAssociatedTransaction()
    {
        $transaction = factory(Transaction::class)->states('with_account')->create();

        $this->actingAs($transaction->user)
            ->get(route('transactions.show', [ 'transaction' => $transaction->id ]))
            ->assertStatus(200)
            ->assertSee(htmlentities($transaction->payee));
    }

    public function testShowWithInvalidIdRedirectsToIndex()
    {
        $this->actingAs(factory(User::class)->create())
            ->get(route('transactions.show', [ 'transaction' => -1 ]))
            ->assertRedirect(route('transactions.index'));
    }

    public function testStorePersistsNewTransactionAndRedirects()
    {
        $transaction = factory(Transaction::class)->states('with_account')->make();

        $this->actingAs(factory(User::class)->create())
            ->post(route('transactions.store', $transaction->toArray()))
            ->assertStatus(302);

        $this->assertDatabaseHas('transactions', $transaction->toArray());
    }

    public function testUpdatePersistsChangesAndRedirects()
    {
        $transaction = factory(Transaction::class)->states('with_account')->create();
        $transaction->amount = 500;

        $this->actingAs($transaction->user)
            ->put(route('transactions.update', [ 'transaction' => $transaction->id ]), $transaction->toArray())
            ->assertStatus(302);

        $this->assertDatabaseHas('transactions', $transaction->toArray());
    }

    public function testDeleteDeletesAndRedirectsToIndex()
    {
        $transaction = factory(Transaction::class)->states('with_account')->create();

        $this->actingAs($transaction->user)
            ->delete(route('transactions.destroy', $transaction->id))
            ->assertRedirect(route('transactions.index'));

        $this->assertDatabaseMissing('transactions', [ 'id' => $transaction->id ]);
    }

    public function testUnsuccessfulDeleteRedirectsWithError()
    {
        $this->actingAs(factory(User::class)->create())
            ->delete(route('transactions.destroy', -1))
            ->assertStatus(302)
            ->assertSessionHas('alerts.danger');
    }
}
