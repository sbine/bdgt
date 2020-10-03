<?php

namespace Tests\Browser;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Carbon;
use Laravel\Dusk\Browser;
use Tests\Browser\Components\Datepicker;
use Tests\DuskTestCase;

/** @group bill */
class BillTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_create_a_bill()
    {
        $user = User::factory()->create();
        $bill = Bill::factory()->make();

        $this->browse(function (Browser $browser) use ($user, $bill) {
            $browser
                ->loginAs($user)
                ->visit(route('bills.index'))
                ->press('.button--success')
                ->waitForText('Add a Bill')
                ->screenshot('features/Bill_Create')
                ->within(new Datepicker, function ($browser) use ($bill) {
                    $browser->selectDate($bill->start_date);
                })
                ->type('[name="label"]', $bill->label)
                ->type('amount', $bill->amount)
                ->type('frequency', $bill->frequency)
                ->press('Save')
                ->assertVisible('.alert--success')
                ->assertSee($bill->label)
                ->logout();
        });
    }

    /** @test */
    public function user_can_edit_a_bill()
    {
        $user = User::factory()->create();
        $this->be($user);
        $bill = Bill::factory()->create();

        $bill->start_date = Carbon::now();
        $bill->label = 'Foo bar';
        $bill->amount = 123.45;
        $bill->frequency = 22;

        $this->browse(function (Browser $browser) use ($user, $bill) {
            $browser
                ->loginAs($user)
                ->visit(route('bills.index'))
                ->click('a[href*="/bills/"]')
                ->click('.button--warning')
                ->waitForText('Edit Bill')
                ->screenshot('features/Bill_Edit')
                ->within(new Datepicker, function ($browser) use ($bill) {
                    $browser->selectDate($bill->start_date);
                })
                ->type('[name="label"]', $bill->label)
                ->type('amount', $bill->amount)
                ->press('Edit')
                ->assertVisible('.alert--success')
                ->assertSee($bill->label)
                ->assertSee($bill->amount)
                ->logout();
        });
    }

    /** @test */
    public function user_can_delete_a_bill()
    {
        $user = User::factory()->create();
        $this->be($user);
        $bill = Bill::factory()->create();

        $this->browse(function (Browser $browser) use ($user, $bill) {
            $browser
                ->loginAs($user)
                ->visit(route('bills.index'))
                ->click('a[href*="/bills/"]')
                ->clickLink('Delete this bill')
                ->waitForText('Delete Bill')
                ->screenshot('features/Bill_Delete')
                ->press('Delete')
                ->assertVisible('.alert--success')
                ->assertDontSee($bill->label)
                ->logout();
        });
    }
}
