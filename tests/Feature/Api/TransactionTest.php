<?php

namespace Tests\Feature\Api;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/** @group transaction */
class TransactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_a_transaction()
    {
        $user = User::factory()->create();
        $this->be($user);

        $transaction = Transaction::factory()->forAccount()->make()->getAttributes();

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

    public function test_user_can_view_their_own_transaction()
    {
        $user = User::factory()->create();
        $this->be($user);

        $transaction = Transaction::factory()->forAccount()->create();

        $this
            ->get(route('api.transactions.show', $transaction->id))
            ->assertJsonFragment([
                'id' => $transaction->id,
                'account_id' => $transaction->account_id,
            ]);
    }

    public function test_user_cannot_view_another_users_transaction()
    {
        $user = User::factory()->create();
        $this->be($user);

        $transaction = Transaction::factory()->forAccount()->create();

        $this
            ->actingAs(User::factory()->create())
            ->get(route('api.transactions.show', $transaction->id))
            ->assertForbidden();
    }

    public function test_user_can_edit_their_own_transaction()
    {
        $user = User::factory()->create();
        $this->be($user);

        $transaction = Transaction::factory()->forAccount()->create();
        $updatedTransaction = Transaction::factory()->forAccount()->make()->getAttributes();

        $this
            ->put(route('api.transactions.update', $transaction->id), $updatedTransaction)
            ->assertSessionHasNoErrors()
            ->assertJsonFragment([
                'success' => true,
            ]);

        $this->assertDatabaseHas('transactions', array_merge(
            $updatedTransaction,
            ['id' => $transaction->id]
        ));
    }

    public function test_user_cannot_edit_another_users_transaction()
    {
        $user = User::factory()->create();
        $this->be($user);

        $transaction = Transaction::factory()->forAccount()->create();
        $updatedTransaction = Transaction::factory()->forAccount()->make()->toArray();

        $this
            ->actingAs(User::factory()->create())
            ->put(route('api.transactions.update', $transaction->id), $updatedTransaction)
            ->assertForbidden();
    }

    public function test_user_can_delete_their_own_transaction()
    {
        $user = User::factory()->create();
        $this->be($user);

        $transaction = Transaction::factory()->forAccount()->create();

        $this
            ->delete(route('api.transactions.destroy', $transaction->id))
            ->assertSessionHasNoErrors()
            ->assertJsonFragment([
                'success' => true,
            ]);

        $this->assertDatabaseMissing('transactions', $transaction->getAttributes());
    }

    public function test_user_cannot_delete_another_users_transaction()
    {
        $user = User::factory()->create();
        $this->be($user);

        $transaction = Transaction::factory()->forAccount()->create();

        $this
            ->actingAs(User::factory()->create())
            ->delete(route('api.transactions.destroy', $transaction->id))
            ->assertForbidden();
    }
}
