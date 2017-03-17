<?php

namespace Bdgt\Tests\Services;

use Bdgt\Reports\NetWorth;
use Bdgt\Reports\ReportInterface;
use Bdgt\Reports\Spending;
use Bdgt\Reports\SpendingByCategory;
use Bdgt\Services\ReportService;
use Bdgt\Tests\TestCase;
use InvalidArgumentException;

class ReportServiceTest extends TestCase
{
    public function testGetName()
    {
        $this->mock(Spending::class, ReportInterface::class)
            ->shouldReceive('name')->once()->andReturn('Report Name');

        $this->assertEquals('Report Name', (new ReportService('spending'))->getReportName());
    }

    public function testGetSpendingReport()
    {
        $reportData = [
            'report',
            'data',
        ];

        $this->mock(Spending::class, ReportInterface::class)
            ->shouldReceive('get')->once()->andReturn($reportData);

        $this->assertEquals($reportData, (new ReportService('spending'))->get());
    }

    public function testGetSpendingByCategoryReport()
    {
        $reportData = [
            'report',
            'data',
        ];

        $this->mock(SpendingByCategory::class, ReportInterface::class)
            ->shouldReceive('get')->once()->andReturn($reportData);

        $this->assertEquals($reportData, (new ReportService('categorial'))->get());
    }

    public function testGetInvalidReportThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);

        (new ReportService(''))->get();
    }
}
