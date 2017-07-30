<?php

namespace Bdgt\Tests\Services;

use Bdgt\Reports\Reportable;
use Bdgt\Reports\ReportFactory;
use Bdgt\Reports\Spending;
use Bdgt\Reports\SpendingByCategory;
use Bdgt\Tests\TestCase;
use InvalidArgumentException;

class ReportFactoryTest extends TestCase
{
    public function testGetName()
    {
        $this->mock(Spending::class, Reportable::class)
            ->shouldReceive('name')->once()->andReturn('Report Name');

        $this->assertEquals('Report Name', ReportFactory::generate('spending')->name());
    }

    public function testGetSpendingReport()
    {
        $reportData = [
            'report',
            'data',
        ];

        $this->mock(Spending::class, Reportable::class)
            ->shouldReceive('get')->once()->andReturn($reportData);

        $this->assertEquals($reportData, ReportFactory::generate('spending')->get());
    }

    public function testGetSpendingByCategoryReport()
    {
        $reportData = [
            'report',
            'data',
        ];

        $this->mock(SpendingByCategory::class, Reportable::class)
            ->shouldReceive('get')->once()->andReturn($reportData);

        $this->assertEquals($reportData, ReportFactory::generate('categorial')->get());
    }

    public function testGetInvalidReportThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);

        ReportFactory::generate('');
    }
}
