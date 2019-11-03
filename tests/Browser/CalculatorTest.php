<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
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
                ->assertSee('January 3rd, 2021')
                ->assertSee('$67.21')
                ->dragRight('.vue-slider-dot-handle', 40)
                ->releaseMouse()
                ->moveMouse(20, 20)
                ->assertSee('October 3rd, 2020')
                ->assertSee('$50.33')
                ->screenshot('features/Debt_Calculator');
        });
    }
}
