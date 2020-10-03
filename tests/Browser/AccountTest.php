<?php

namespace Tests\Browser;

use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Carbon;
use Laravel\Dusk\Browser;
use Tests\Browser\Components\Datepicker;
use Tests\DuskTestCase;

/** @group account */
class AccountTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_create_a_account()
    {
        $user = User::factory()->create();
        $account = Account::factory()->make();

        $this->browse(function (Browser $browser) use ($user, $account) {
            $browser
                ->loginAs($user)
                ->visit(route('accounts.index'))
                ->press('.button--success')
                ->waitForText('Add an Account')
                ->screenshot('features/Account_Create')
                ->within(new Datepicker, function ($browser) use ($account) {
                    $browser->selectDate($account->date_opened);
                })
                ->type('name', $account->name)
                ->type('balance', $account->balance)
                ->type('interest', $account->interest)
                ->press('Save')
                ->assertVisible('.alert--success')
                ->assertSee($account->name)
                ->logout();
        });
    }

    /** @test */
    public function user_can_edit_a_account()
    {
        $user = User::factory()->create();
        $this->be($user);
        $account = Account::factory()->create();

        $account->date_opened = Carbon::now();
        $account->name = 'Foo bar';
        $account->balance = 123.45;
        $account->interest = 0.22;

        $this->browse(function (Browser $browser) use ($user, $account) {
            $browser
                ->loginAs($user)
                ->visit(route('accounts.index'))
                ->click('a[href*="/accounts/"]')
                ->click('.button--warning')
                ->waitForText('Edit Account')
                ->screenshot('features/Account_Edit')
                ->within(new Datepicker, function ($browser) use ($account) {
                    $browser->selectDate($account->date_opened);
                })
                ->type('name', $account->name)
                ->type('balance', $account->balance)
                ->type('interest', $account->interest)
                ->press('Edit')
                ->assertVisible('.alert--success')
                ->assertSee($account->name)
                ->assertSee($account->interest)
                ->logout();
        });
    }

    /** @test */
    public function user_can_delete_a_account()
    {
        $user = User::factory()->create();
        $this->be($user);
        $account = Account::factory()->create();

        $this->browse(function (Browser $browser) use ($user, $account) {
            $browser
                ->loginAs($user)
                ->visit(route('accounts.index'))
                ->click('a[href*="/accounts/"]')
                ->clickLink('Delete this account')
                ->waitForText('Delete Account')
                ->screenshot('features/Account_Delete')
                ->press('Delete')
                ->assertVisible('.alert--success')
                ->assertDontSee($account->name)
                ->logout();
        });
    }
}
