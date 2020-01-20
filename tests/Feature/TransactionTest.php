<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/** @group transaction */
class TransactionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Transaction::flushEventListeners();
        Account::flushEventListeners();
    }

    /** @test */
    public function index_displays_all_transactions()
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

    /** @test */
    public function show_displays_associated_transaction()
    {
        $transaction = factory(Transaction::class)->states('with_account')->create();

        $this->actingAs($transaction->user)
            ->get(route('transactions.show', $transaction))
            ->assertStatus(200)
            ->assertSee(htmlentities($transaction->payee));
    }

    /** @test */
    public function cannot_view_another_users_transaction()
    {
        $transaction = factory(Transaction::class)->states('with_account')->create();

        $this->actingAs(factory(User::class)->create())
            ->get(route('transactions.show', $transaction))
            ->assertNotFound();
    }

    /** @test */
    public function store_persists_new_transaction_and_redirects()
    {
        $transaction = factory(Transaction::class)->states('with_account')->make();

        $this->actingAs(factory(User::class)->create())
            ->post(route('transactions.store', $transaction->toArray()))
            ->assertStatus(302);

        $this->assertDatabaseHas('transactions', $transaction->toArray());
    }

    /** @test */
    public function update_persists_changes_and_redirects()
    {
        $transaction = factory(Transaction::class)->states('with_account')->create();
        $transaction->amount = 500;

        $this->actingAs($transaction->user)
            ->put(route('transactions.update', $transaction), $transaction->toArray())
            ->assertStatus(302);

        $this->assertDatabaseHas('transactions', $transaction->toArray());
    }

    /** @test */
    public function cannot_update_another_users_transaction()
    {
        $transaction = factory(Transaction::class)->states('with_account')->create();

        $this->actingAs(factory(User::class)->create())
            ->put(route('transactions.update', $transaction), [])
            ->assertNotFound();
    }

    /** @test */
    public function delete_deletes_and_redirects_to_index()
    {
        $transaction = factory(Transaction::class)->states('with_account')->create();

        $this->actingAs($transaction->user)
            ->delete(route('transactions.destroy', $transaction))
            ->assertRedirect(route('dashboard'));

        $this->assertDatabaseMissing('transactions', ['id' => $transaction->id]);
    }

    /** @test */
    public function cannot_delete_another_users_transaction()
    {
        $transaction = factory(Transaction::class)->states('with_account')->create();

        $this->actingAs(factory(User::class)->create())
            ->delete(route('transactions.destroy', $transaction))
            ->assertNotFound();

        $this->assertDatabaseHas('transactions', ['id' => $transaction->id]);
    }
}
