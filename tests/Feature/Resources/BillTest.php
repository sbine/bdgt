<?php

namespace Tests\Feature\Resources;

use App\Models\Bill;
use App\Models\Transaction;
use App\Models\User;
use Tests\TestCase;
use DateInterval;
use DateTime;
use Carbon\Carbon;

class BillTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->be(factory(User::class)->create());
    }

    public function testPaidAttribute()
    {
        $bill = factory(Bill::class)->make([
            'start_date' => (new DateTime)->sub(new DateInterval('P45D'))->format('Y-m-d'),
            'frequency' => 30,
            'amount' => 140,
        ]);
        $bill->setRelation('transactions', factory(Transaction::class, 3)->make([
            'amount' => 60,
            'inflow' => false,
            'date' => date('Y-m-d H:i:s')
        ]));

        $this->assertTrue($bill->paid);
    }

    public function testGetDueDatesForInterval()
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
