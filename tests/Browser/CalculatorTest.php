<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Carbon;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/** @group calculator */
class CalculatorTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_unauthenticated_user_can_use_debt_calculator()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit(route('calculators.debt'))
                ->assertSee('Debt Calculator')
                ->assertSee(Carbon::now()->addYear()->addMonths(2)->format('F jS, Y'))
                ->assertSee('$67.21')
                ->dragRight('.vue-slider-dot-handle', 40)
                ->pause(100)
                ->releaseMouse()
                ->moveMouse(20, 20)
                ->assertSee(Carbon::now()->addYear()->subMonth()->format('F jS, Y'))
                ->assertSee('$50.33')
                ->screenshot('features/Debt_Calculator');
        });
    }
}
