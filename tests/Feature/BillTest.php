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
        $user = User::factory()->create();
        $bills = Bill::factory()->count(3)->create([
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
        $bill = Bill::factory()->forUser()->create();

        $this->actingAs($bill->user)
            ->get(route('bills.show', $bill))
            ->assertStatus(200)
            ->assertSee($bill->label);
    }

    /** @test */
    public function cannot_view_another_users_bill()
    {
        $bill = Bill::factory()->forUser()->create();

        $this->actingAs(User::factory()->create())
            ->get(route('bills.show', $bill))
            ->assertNotFound();
    }

    /** @test */
    public function store_persists_new_bill_and_redirects()
    {
        $user = User::factory()->create();
        $this->be($user);

        $bill = Bill::factory()->make();

        $this
            ->post(route('bills.store', $bill->toArray()))
            ->assertStatus(302);

        $this->assertEquals($user->id, $bill->user_id);
        $this->assertDatabaseHas('bills', $bill->getAttributes());
    }

    /** @test */
    public function unsuccessful_store_redirects_with_error()
    {
        $this->actingAs(User::factory()->create())
            ->post(route('bills.store', []))
            ->assertStatus(302)
            ->assertSessionHas('errors');
    }

    /** @test */
    public function update_persists_changes_and_redirects()
    {
        $bill = Bill::factory()->forUser()->create();
        $bill->amount = 500;

        $this->actingAs($bill->user)
            ->put(route('bills.update', $bill), $bill->toArray())
            ->assertRedirect(route('bills.show', $bill));
    }

    /** @test */
    public function cannot_update_another_users_bill()
    {
        $bill = Bill::factory()->forUser()->create();

        $this->actingAs(User::factory()->create())
            ->put(route('bills.update', $bill), [])
            ->assertNotFound();
    }

    /** @test */
    public function delete_deletes_and_redirects_to_index()
    {
        $bill = Bill::factory()->forUser()->create();

        $this->actingAs($bill->user)
            ->delete(route('bills.destroy', $bill))
            ->assertRedirect(route('bills.index'));

        $this->assertDatabaseMissing('bills', ['id' => $bill->id]);
    }

    /** @test */
    public function cannot_delete_another_users_bill()
    {
        $bill = Bill::factory()->forUser()->create();

        $this->actingAs(User::factory()->create())
            ->delete(route('bills.destroy', $bill))
            ->assertNotFound();

        $this->assertDatabaseHas('bills', ['id' => $bill->id]);
    }
}
