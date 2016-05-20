<?php

class BillTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->model = $this->mock('Bdgt\Resources\Bill[save,update,create,delete,destroy]');
    }

    public function testGetDueDatesForInterval()
    {
        $intervalStart = '2015-01-01';
        $intervalEnd = '2015-12-31';
        $frequency  = 30;
        $initialStart = '2011-01-01';

        $dueDates = $this->model->getDueDatesForInterval($intervalStart, $intervalEnd, $frequency, $initialStart);

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
