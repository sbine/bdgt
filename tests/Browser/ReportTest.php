<?php

namespace Tests\Browser;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Carbon;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/** @group report */
class ReportTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_user_can_view_spending_by_category_report()
    {
        $user = User::factory()->create();
        $this->be($user);
        Category::factory()->create()
            ->transactions()->saveMany(
                Transaction::factory()->count(2)->forAccount()->create([
                    'date' => Carbon::now()->startOfMonth(),
                ])
            );

        $this->browse(function (Browser $browser) use ($user) {
            $browser
                ->loginAs($user)
                ->visit(route('reports.show', 'categorial'))
                ->assertSee('Spending By Category')
                // Let the report finish loading
                ->pause(800)
                ->screenshot('features/Report_Spending_By_Category')
                ->logout();
        });
    }

    public function test_user_can_view_spending_over_time_report()
    {
        $user = User::factory()->create();
        $this->be($user);
        Category::factory()->create()
            ->transactions()->saveMany(
                Transaction::factory()->count(2)->forAccount()->create([
                    'date' => Carbon::now()->startOfMonth(),
                ])
            );

        $this->browse(function (Browser $browser) use ($user) {
            $browser
                ->loginAs($user)
                ->visit(route('reports.show', 'spending'))
                ->assertSee('Spending Over Time')
                // @TODO: This report fails in SQLite due to `IF` and `DATE_FORMAT`
                ->pause(800)
                ->screenshot('features/Report_Spending_Over_Time')
                ->logout();
        });
    }
}
