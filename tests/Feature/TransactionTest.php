<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
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
            'account_id' => $account->id,
        ]);

        $self = $this->actingAs($account->user)
            ->get(route('dashboard'))
            ->assertStatus(200);

        $transactions->each(function ($transaction) use ($self) {
            $self->assertSee(e($transaction->payee));
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

    public function testCannotViewAnotherUsersTransaction()
    {
        $transaction = factory(Transaction::class)->states('with_account')->create();

        $this->actingAs(factory(User::class)->create())
            ->get(route('transactions.show', [ 'transaction' => $transaction->id ]))
            ->assertNotFound();
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

    public function testCannotUpdateAnotherUsersTransaction()
    {
        $transaction = factory(Transaction::class)->states('with_account')->create();

        $this->actingAs(factory(User::class)->create())
            ->put(route('transactions.update', ['transaction' => $transaction->id]), [])
            ->assertNotFound();
    }

    public function testDeleteDeletesAndRedirectsToIndex()
    {
        $transaction = factory(Transaction::class)->states('with_account')->create();

        $this->actingAs($transaction->user)
            ->delete(route('transactions.destroy', $transaction->id))
            ->assertRedirect(route('dashboard'));

        $this->assertDatabaseMissing('transactions', [ 'id' => $transaction->id ]);
    }

    public function testCannotDeleteAnotherUsersTransaction()
    {
        $transaction = factory(Transaction::class)->states('with_account')->create();

        $this->actingAs(factory(User::class)->create())
            ->delete(route('transactions.destroy', $transaction->id))
            ->assertNotFound();
    }
}
