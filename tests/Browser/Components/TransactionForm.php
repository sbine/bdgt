<?php

namespace Tests\Browser\Components;

use App\Models\Transaction;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Component as BaseComponent;
use Tests\Browser\Components\Datepicker;

class TransactionForm extends BaseComponent
{
    /**
     * Get the root selector for the component.
     *
     * @return string
     */
    public function selector()
    {
        return '[dusk="transaction-form"]';
    }

    /**
     * Assert that the browser page contains the component.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertVisible($this->selector());
    }

    /**
     * Get the element shortcuts for the component.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@save-button' => '.button--primary',
        ];
    }

    public function fillTransaction($browser, Transaction $transaction)
    {
        $browser
            ->waitFor('@save-button')
            ->within(new Datepicker, function ($browser) use ($transaction) {
                $browser->selectDate($transaction->date);
            })
            ->type('amount', $transaction->amount)
            ->type('payee', $transaction->payee)
            ->press('@save-button');
    }
}
