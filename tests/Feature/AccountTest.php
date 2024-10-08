<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/** @group account */
class AccountTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Account::flushEventListeners();
    }

    public function test_index_displays_all_accounts()
    {
        $user = User::factory()->create();
        $accounts = Account::factory()->count(3)->create([
            'user_id' => $user->id,
        ]);

        $self = $this->actingAs($user)
            ->get(route('accounts.index'))
            ->assertStatus(200);

        $accounts->each(function ($account) use ($self) {
            $self->assertSee($account->name);
        });
    }

    public function test_show_displays_associated_account()
    {
        $account = Account::factory()->forUser()->create();

        $this->actingAs($account->user)
            ->get(route('accounts.show', $account))
            ->assertStatus(200)
            ->assertSee($account->name);
    }

    public function test_cannot_view_another_users_account()
    {
        $account = Account::factory()->create();

        $this->actingAs(User::factory()->create())
            ->get(route('accounts.show', $account))
            ->assertNotFound();
    }

    public function test_store_persists_new_account_and_redirects()
    {
        $user = User::factory()->create();
        $this->be($user);

        $account = Account::factory()->make();

        $this
            ->actingAs($user)
            ->post(route('accounts.store', $account->toArray()))
            ->assertStatus(302);

        $this->assertEquals($user->id, $account->user_id);
        $this->assertDatabaseHas('accounts', $account->getAttributes());
    }

    public function test_unsuccessful_store_redirects_with_error()
    {
        $this->actingAs(User::factory()->create())
            ->post(route('accounts.store', []))
            ->assertStatus(302)
            ->assertSessionHas('errors');
    }

    public function test_update_persists_changes_and_redirects()
    {
        $account = Account::factory()->forUser()->create();
        $account->balance = 500;

        $this->actingAs($account->user)
            ->put(route('accounts.update', $account), $account->toArray())
            ->assertRedirect(route('accounts.show', $account));

        $this->assertDatabaseHas('accounts', $account->makeHidden('updated_at')->getAttributes());
    }

    public function test_cannot_update_another_users_account()
    {
        $account = Account::factory()->create();

        $this->actingAs(User::factory()->create())
            ->put(route('accounts.update', $account), [])
            ->assertNotFound();
    }

    public function test_delete_deletes_and_redirects_to_index()
    {
        $account = Account::factory()->forUser()->create();

        $this->actingAs($account->user)
            ->delete(route('accounts.destroy', $account))
            ->assertRedirect(route('accounts.index'));

        $this->assertDatabaseMissing('accounts', ['id' => $account->id]);
    }

    public function test_cannot_delete_another_users_account()
    {
        $account = Account::factory()->create();

        $this->actingAs(User::factory()->create())
            ->delete(route('accounts.destroy', $account))
            ->assertNotFound();

        $this->assertDatabaseHas('accounts', ['id' => $account->id]);
    }
}
