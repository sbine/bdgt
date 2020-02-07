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

    /** @test */
    public function index_displays_all_accounts()
    {
        $user = factory(User::class)->create();
        $accounts = factory(Account::class, 3)->create([
            'user_id' => $user->id,
        ]);

        $self = $this->actingAs($user)
            ->get(route('accounts.index'))
            ->assertStatus(200);

        $accounts->each(function ($account) use ($self) {
            $self->assertSee(htmlentities($account->name));
        });
    }

    /** @test */
    public function show_displays_associated_account()
    {
        $account = factory(Account::class)->states('with_user')->create();

        $this->actingAs($account->user)
            ->get(route('accounts.show', $account))
            ->assertStatus(200)
            ->assertSee($account->name);
    }

    /** @test */
    public function cannot_view_another_users_account()
    {
        $account = factory(Account::class)->states('with_user')->create();

        $this->actingAs(factory(User::class)->create())
            ->get(route('accounts.show', $account))
            ->assertNotFound();
    }

    /** @test */
    public function store_persists_new_account_and_redirects()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $account = factory(Account::class)->make();

        $this
            ->post(route('accounts.store', $account->toArray()))
            ->assertStatus(302);

        $this->assertEquals($user->id, $account->user_id);
        $this->assertDatabaseHas('accounts', $account->toArray());
    }

    /** @test */
    public function unsuccessful_store_redirects_with_error()
    {
        $this->actingAs(factory(User::class)->create())
            ->post(route('accounts.store', []))
            ->assertStatus(302)
            ->assertSessionHas('errors');
    }

    /** @test */
    public function update_persists_changes_and_redirects()
    {
        $account = factory(Account::class)->states('with_user')->create();
        $account->balance = 500;

        $this->actingAs($account->user)
            ->put(route('accounts.update', $account), $account->toArray())
            ->assertRedirect(route('accounts.show', $account));

        $this->assertDatabaseHas('accounts', $account->toArray());
    }

    /** @test */
    public function cannot_update_another_users_account()
    {
        $account = factory(Account::class)->states('with_user')->create();

        $this->actingAs(factory(User::class)->create())
            ->put(route('accounts.update', $account), [])
            ->assertNotFound();
    }

    /** @test */
    public function delete_deletes_and_redirects_to_index()
    {
        $account = factory(Account::class)->states('with_user')->create();

        $this->actingAs($account->user)
            ->delete(route('accounts.destroy', $account))
            ->assertRedirect(route('accounts.index'));

        $this->assertDatabaseMissing('accounts', ['id' => $account->id]);
    }

    /** @test */
    public function cannot_delete_another_users_account()
    {
        $account = factory(Account::class)->states('with_user')->create();

        $this->actingAs(factory(User::class)->create())
            ->delete(route('accounts.destroy', $account))
            ->assertNotFound();

        $this->assertDatabaseHas('accounts', ['id' => $account->id]);
    }
}
