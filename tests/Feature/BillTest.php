<?php

namespace Tests\Feature;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/** @group bill */
class BillTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Bill::flushEventListeners();
    }

    /** @test */
    public function index_displays_all_bills()
    {
        $user = factory(User::class)->create();
        $bills = factory(Bill::class, 3)->create([
            'user_id' => $user->id,
        ]);

        $self = $this->actingAs($user)
            ->get(route('bills.index'))
            ->assertStatus(200);

        $bills->each(function ($bill) use ($self) {
            $self->assertSee($bill->label);
        });
    }

    /** @test */
    public function show_displays_associated_bill()
    {
        $bill = factory(Bill::class)->states('with_user')->create();

        $this->actingAs($bill->user)
            ->get(route('bills.show', $bill))
            ->assertStatus(200)
            ->assertSee($bill->label);
    }

    /** @test */
    public function cannot_view_another_users_bill()
    {
        $bill = factory(Bill::class)->states('with_user')->create();

        $this->actingAs(factory(User::class)->create())
            ->get(route('bills.show', $bill))
            ->assertNotFound();
    }

    /** @test */
    public function store_persists_new_bill_and_redirects()
    {
        $bill = factory(Bill::class)->make();

        $this->actingAs(factory(User::class)->create())
            ->post(route('bills.store', $bill->toArray()))
            ->assertStatus(302);

        $this->assertDatabaseHas('bills', $bill->toArray());
    }

    /** @test */
    public function unsuccessful_store_redirects_with_error()
    {
        $this->actingAs(factory(User::class)->create())
            ->post(route('bills.store', []))
            ->assertStatus(302)
            ->assertSessionHas('errors');
    }

    /** @test */
    public function update_persists_changes_and_redirects()
    {
        $bill = factory(Bill::class)->states('with_user')->create();
        $bill->amount = 500;

        $this->actingAs($bill->user)
            ->put(route('bills.update', $bill), $bill->toArray())
            ->assertRedirect(route('bills.show', $bill));
    }

    /** @test */
    public function cannot_update_another_users_bill()
    {
        $bill = factory(Bill::class)->states('with_user')->create();

        $this->actingAs(factory(User::class)->create())
            ->put(route('bills.update', $bill), [])
            ->assertNotFound();
    }

    /** @test */
    public function delete_deletes_and_redirects_to_index()
    {
        $bill = factory(Bill::class)->states('with_user')->create();

        $this->actingAs($bill->user)
            ->delete(route('bills.destroy', $bill))
            ->assertRedirect(route('bills.index'));

        $this->assertDatabaseMissing('bills', ['id' => $bill->id]);
    }

    /** @test */
    public function cannot_delete_another_users_bill()
    {
        $bill = factory(Bill::class)->states('with_user')->create();

        $this->actingAs(factory(User::class)->create())
            ->delete(route('bills.destroy', $bill))
            ->assertNotFound();

        $this->assertDatabaseHas('bills', ['id' => $bill->id]);
    }
}
