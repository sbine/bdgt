<?php

namespace Tests\Feature\Services;

use App\Reports\Reportable;
use App\Reports\ReportFactory;
use App\Reports\Spending;
use App\Reports\SpendingByCategory;
use Tests\TestCase;
use InvalidArgumentException;

class ReportFactoryTest extends TestCase
{
    public function testGetName()
    {
        $this->mock(Spending::class, function () { return Reportable::class; })
            ->shouldReceive('name')->once()->andReturn('Report Name');

        $this->assertEquals('Report Name', ReportFactory::generate('spending')->name());
    }

    public function testGetSpendingReport()
    {
        $reportData = [
            'report',
            'data',
        ];

        $this->mock(Spending::class, function () { return Reportable::class; })
            ->shouldReceive('get')->once()->andReturn($reportData);

        $this->assertEquals($reportData, ReportFactory::generate('spending')->get());
    }

    public function testGetSpendingByCategoryReport()
    {
        $reportData = [
            'report',
            'data',
        ];

        $this->mock(SpendingByCategory::class, function () { return Reportable::class; })
            ->shouldReceive('get')->once()->andReturn($reportData);

        $this->assertEquals($reportData, ReportFactory::generate('categorial')->get());
    }

    public function testGetInvalidReportThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);

        ReportFactory::generate('');
    }
}
