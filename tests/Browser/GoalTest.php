<?php

namespace Tests\Browser;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Carbon;
use Laravel\Dusk\Browser;
use Tests\Browser\Components\Datepicker;
use Tests\DuskTestCase;

/** @group goal */
class GoalTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_create_a_goal()
    {
        $user = User::factory()->create();
        $goal = Goal::factory()->make();

        $this->browse(function (Browser $browser) use ($user, $goal) {
            $browser
                ->loginAs($user)
                ->visit(route('goals.index'))
                ->press('.button--success')
                ->waitForText('Add a Goal')
                ->screenshot('features/Goal_Create')
                ->within(new Datepicker, function ($browser) use ($goal) {
                    $browser->selectDate($goal->goal_date);
                })
                ->type('[name="label"]', $goal->label)
                ->type('amount', $goal->amount)
                // Ensure we don't select the hidden balance input
                ->type('[type="number"][name="balance"]', $goal->balance)
                ->press('Save')
                ->assertVisible('.alert--success')
                ->assertSee($goal->label)
                ->logout();
        });
    }

    /** @test */
    public function user_can_edit_a_goal()
    {
        $user = User::factory()->create();
        $this->be($user);
        $goal = Goal::factory()->create();

        $goal->goal_date = Carbon::now();
        $goal->label = 'Foo bar';
        $goal->balance = 123.45;

        $this->browse(function (Browser $browser) use ($user, $goal) {
            $browser
                ->loginAs($user)
                ->visit(route('goals.index'))
                ->click('a[href*="/goals/"]')
                ->click('.button--warning')
                ->waitForText('Edit Goal')
                ->screenshot('features/Goal_Edit')
                ->within(new Datepicker, function ($browser) use ($goal) {
                    $browser->selectDate($goal->goal_date);
                })
                ->type('[name="label"]', $goal->label)
                ->type('balance', $goal->balance)
                ->press('Edit')
                ->assertVisible('.alert--success')
                ->assertSee($goal->label)
                ->assertSee($goal->balance)
                ->logout();
        });
    }

    /** @test */
    public function user_can_delete_a_goal()
    {
        $user = User::factory()->create();
        $this->be($user);
        $goal = Goal::factory()->create();

        $this->browse(function (Browser $browser) use ($user, $goal) {
            $browser
                ->loginAs($user)
                ->visit(route('goals.index'))
                ->click('a[href*="/goals/"]')
                ->clickLink('Delete this goal')
                ->waitForText('Delete Goal')
                ->screenshot('features/Goal_Delete')
                ->press('Delete')
                ->assertVisible('.alert--success')
                ->assertDontSee($goal->label)
                ->logout();
        });
    }
}
