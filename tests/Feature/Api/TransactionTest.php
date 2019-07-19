<?php

namespace Tests\Feature\Api;

use App\Resources\Transaction;
use App\Resources\User;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    /** @test */
    function user_can_create_a_transaction()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $transaction = factory(Transaction::class)->states('with_account')->make()->toArray();

        $this
            ->post(route('api.transactions.store'), $transaction)
            ->assertOk()
            ->assertJsonFragment([
                'success' => true,
            ]);

        $this->assertDatabaseHas('transactions', array_merge($transaction, [
            'user_id' => $user->id,
        ]));
    }

    /** @test */
    function user_can_view_their_own_transaction()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $transaction = factory(Transaction::class)->states('with_account')->create();

        $this
            ->get(route('api.transactions.show', $transaction->id))
            ->assertJsonFragment([
                'id' => $transaction->id,
                'account' => $transaction->account->name,
            ]);
    }

    /** @test */
    function user_cannot_view_another_users_transaction()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $transaction = factory(Transaction::class)->states('with_account')->create();

        $this
            ->actingAs(factory(User::class)->create())
            ->get(route('api.transactions.show', $transaction->id))
            ->assertForbidden();
    }

    /** @test */
    function user_can_edit_their_own_transaction()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $transaction = factory(Transaction::class)->states('with_account')->create();
        $updatedTransaction = factory(Transaction::class)->states('with_account')->make()->toArray();

        $this
            ->put(route('api.transactions.update', $transaction->id), $updatedTransaction)
            ->assertSessionHasNoErrors()
            ->assertJsonFragment([
                'success' => true,
            ]);

        $this->assertDatabaseHas('transactions', array_merge(
            $updatedTransaction,
            [ 'id' => $transaction->id ]
        ));
    }

    /** @test */
    function user_cannot_edit_another_users_transaction()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $transaction = factory(Transaction::class)->states('with_account')->create();
        $updatedTransaction = factory(Transaction::class)->states('with_account')->make()->toArray();

        $this
            ->actingAs(factory(User::class)->create())
            ->put(route('api.transactions.update', $transaction->id), $updatedTransaction)
            ->assertForbidden();
    }

    /** @test */
    function user_can_delete_their_own_transaction()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $transaction = factory(Transaction::class)->states('with_account')->create();

        $this
            ->delete(route('api.transactions.destroy', $transaction->id))
            ->assertSessionHasNoErrors()
            ->assertJsonFragment([
                'success' => true,
            ]);

        $this->assertDatabaseMissing('transactions', $transaction->toArray());
    }
}
