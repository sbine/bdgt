<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\User;
use Tests\TestCase;

class AccountTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Account::flushEventListeners();
    }

    public function testIndexDisplaysAllAccounts()
    {
        $user = factory(User::class)->create();
        $accounts = factory(Account::class, 3)->create([
            'user_id' => $user->id
        ]);

        $self = $this->actingAs($user)
            ->get(route('accounts.index'))
            ->assertStatus(200);

        $accounts->each(function ($account) use ($self) {
            $self->assertSee(htmlentities($account->name));
        });
    }

    public function testShowDisplaysAssociatedAccount()
    {
        $account = factory(Account::class)->states('with_user')->create();

        $this->actingAs($account->user)
            ->get(route('accounts.show', [ 'account' => $account->id ]))
            ->assertStatus(200)
            ->assertSee($account->name);
    }

    public function testCannotViewAnotherUsersAccount()
    {
        $account = factory(Account::class)->states('with_user')->create();

        $this->actingAs(factory(User::class)->create())
            ->get(route('accounts.show', [ 'account' => $account->id ]))
            ->assertNotFound();
    }

    public function testStorePersistsNewAccountAndRedirects()
    {
        $account = factory(Account::class)->make();

        $this->actingAs(factory(User::class)->create())
            ->post(route('accounts.store', $account->toArray()))
            ->assertStatus(302);

        $this->assertDatabaseHas('accounts', $account->toArray());
    }

    public function testUnsuccessfulStoreRedirectsWithError()
    {
        $this->actingAs(factory(User::class)->create())
            ->post(route('accounts.store', []))
            ->assertStatus(302)
            ->assertSessionHas('errors');
    }

    public function testUpdatePersistsChangesAndRedirects()
    {
        $account = factory(Account::class)->states('with_user')->create();
        $account->balance = 500;

        $this->actingAs($account->user)
            ->put(route('accounts.update', [ 'account' => $account->id ]), $account->toArray())
            ->assertRedirect(route('accounts.show', [ 'account' => $account->id ]));

        $this->assertDatabaseHas('accounts', $account->toArray());
    }

    public function testCannotUpdateAnotherUsersAccount()
    {
        $account = factory(Account::class)->states('with_user')->create();

        $this->actingAs(factory(User::class)->create())
            ->put(route('accounts.update', [ 'account' => $account->id ]), [])
            ->assertNotFound();
    }

    public function testDeleteDeletesAndRedirectsToIndex()
    {
        $account = factory(Account::class)->states('with_user')->create();

        $this->actingAs($account->user)
            ->delete(route('accounts.destroy', $account->id))
            ->assertRedirect(route('accounts.index'));

        $this->assertDatabaseMissing('accounts', [ 'id' => $account->id ]);
    }

    public function testCannotDeleteAnotherUsersAccount()
    {
        $account = factory(Account::class)->states('with_user')->create();

        $this->actingAs(factory(User::class)->create())
            ->delete(route('accounts.destroy', $account->id))
            ->assertNotFound();
    }
}
