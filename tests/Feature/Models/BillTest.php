<?php

namespace Tests\Feature\Models;

use App\Models\Bill;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/** @group bill */
class BillTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function total_attribute_returns_total_outflows()
    {
        $bill = factory(Bill::class)->make(['start_date' => Carbon::yesterday()]);
        $bill->setRelation('transactions', factory(Transaction::class, 3)->make([
            'amount' => 60,
            'inflow' => false,
            'date' => Carbon::now(),
        ])->mergeRecursive(factory(Transaction::class, 2)->make([
            'amount' => 20,
            'inflow' => true,
            'date' => Carbon::now(),
        ])));

        $this->assertEquals(180, $bill->total);
    }

    /** @test */
    public function paid_attribute_returns_true_when_bill_is_paid()
    {
        $bill = factory(Bill::class)->make([
            'start_date' => Carbon::now()->subDays(45)->format('Y-m-d'),
            'frequency' => 30,
            'amount' => 140,
        ]);
        $bill->setRelation('transactions', factory(Transaction::class, 3)->make([
            'amount' => 60,
            'inflow' => false,
            'date' => Carbon::now(),
        ]));

        $this->assertTrue($bill->paid);
    }

    /** @test */
    public function paid_attribute_returns_false_when_bill_is_unpaid()
    {
        $bill = factory(Bill::class)->make([
            'start_date' => Carbon::now()->subDays(45)->format('Y-m-d'),
            'frequency' => 30,
            'amount' => 140,
        ]);

        $this->assertFalse($bill->paid);
    }

    /** @test */
    public function get_due_dates_for_interval_returns_expected_dates()
    {
        $bill = new Bill([
            'start_date' => new Carbon('2011-01-01'),
            'frequency' => 30,
        ]);
        $intervalStart = '2015-01-01';
        $intervalEnd = '2015-12-31';

        $dueDates = $bill->getDueDatesForInterval($intervalStart, $intervalEnd);

        $this->assertEquals([
            '2015-01-10',
            '2015-02-09',
            '2015-03-11',
            '2015-04-10',
            '2015-05-10',
            '2015-06-09',
            '2015-07-09',
            '2015-08-08',
            '2015-09-07',
            '2015-10-07',
            '2015-11-06',
            '2015-12-06',
        ], $dueDates);
    }
}
