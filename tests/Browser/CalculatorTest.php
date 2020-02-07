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

    /** @test */
    public function unauthenticated_user_can_use_debt_calculator()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit(route('calculators.debt'))
                ->assertSee('Debt Calculator')
                ->assertSee(Carbon::now()->addYear()->addDays(59)->format('F jS, Y'))
                ->assertSee('$67.21')
                ->dragRight('.vue-slider-dot-handle', 40)
                ->releaseMouse()
                ->moveMouse(20, 20)
                ->assertSee(Carbon::now()->addDays(335)->format('F jS, Y'))
                ->assertSee('$50.33')
                ->screenshot('features/Debt_Calculator');
        });
    }
}
