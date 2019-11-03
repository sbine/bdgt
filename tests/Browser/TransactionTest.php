<?php

namespace Tests\Browser;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Carbon;
use Laravel\Dusk\Browser;
use Tests\Browser\Components\Datepicker;
use Tests\Browser\Components\TransactionForm;
use Tests\Browser\Pages\Dashboard;
use Tests\DuskTestCase;

/** @group transaction */
class TransactionTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_create_a_transaction()
    {
        $user = factory(User::class)->create();
        // Authenticate to establish tenancy before seeding
        $this->be($user);
        $transaction = factory(Transaction::class)->states('with_account')->make();
        $category = factory(Category::class)->create();

        $this->browse(function (Browser $browser) use ($user, $transaction, $category) {
            $browser
                ->loginAs($user)
                ->visit(new Dashboard)
                ->press('@add-transaction')
                ->waitForText('Add a Transaction')
                ->screenshot('features/Transaction_Create')
                ->within(new Datepicker, function ($browser) use ($transaction) {
                    $browser->selectDate($transaction->date);
                })
                ->type('amount', $transaction->amount)
                ->type('payee', $transaction->payee)
                ->select('account_id', $transaction->account_id)
                ->select('category_id', $category->id)
                ->press('Save')
                ->assertVisible('.alert--success')
                ->assertSee($transaction->payee)
                ->logout();
        });
    }

    /** @test */
    public function user_can_edit_a_transaction()
    {
        $user = factory(User::class)->create();
        $this->be($user);
        $transaction = factory(Transaction::class)->states('with_account')->create();

        $transaction->date = Carbon::now();
        $transaction->payee = 'Foo bar';
        $transaction->amount = 123.45;

        $this->browse(function (Browser $browser) use ($user, $transaction) {
            $browser
                ->loginAs($user)
                ->visit(new Dashboard)
                ->click('@edit-transaction')
                ->waitForText('Edit Transaction')
                ->screenshot('features/Transaction_Edit')
                ->within(new TransactionForm, function ($browser) use ($transaction) {
                    $browser->fillTransaction($transaction);
                })
                ->waitForReload()
                ->assertVisible('.alert--success')
                ->assertSee($transaction->payee)
                ->assertSee($transaction->amount)
                ->logout();
        });
    }

    /** @test */
    public function user_can_delete_a_transaction()
    {
        $user = factory(User::class)->create();
        $this->be($user);
        $transaction = factory(Transaction::class)->states('with_account')->create();

        $this->browse(function (Browser $browser) use ($user, $transaction) {
            $browser
                ->loginAs($user)
                ->visit(new Dashboard)
                ->click('@delete-transaction')
                ->waitForText('Delete Transaction')
                ->screenshot('features/Transaction_Delete')
                ->within(new TransactionForm, function ($browser) {
                    $browser->click('@save-button');
                })
                ->waitForReload()
                ->assertVisible('.alert--success')
                ->assertDontSee($transaction->payee)
                ->logout();
        });
    }
}
