<?php

namespace Tests\Browser\Components;

use Illuminate\Support\Carbon;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Component as BaseComponent;

class Datepicker extends BaseComponent
{
    /**
     * Get the root selector for the component.
     *
     * @return string
     */
    public function selector()
    {
        return '[dusk="datepicker"]';
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
            '@datepicker-trigger' => '.input-addon--end',
        ];
    }

    public function selectDate($browser, Carbon $date)
    {
        $browser
            ->click('@datepicker-trigger')
            ->waitFor('.vc-title')
            // For now, just select the last day of the first week
            ->click('.on-top.on-right')
            ->click('@datepicker-trigger')
            ->waitUntilMissing('.vc-title');
    }
}
