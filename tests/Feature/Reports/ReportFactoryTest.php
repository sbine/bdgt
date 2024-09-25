<?php

namespace Tests\Feature\Reports;

use App\Reports\Reportable;
use App\Reports\ReportFactory;
use App\Reports\Spending;
use App\Reports\SpendingByCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Tests\TestCase;

/** @group report */
class ReportFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_the_report_name()
    {
        $this->assertEquals('spending_over_time', ReportFactory::generate('spending')->name());
    }

    public function test_it_returns_spending_report_data()
    {
        $reportData = [
            'report',
            'data',
        ];

        $this->mock(Spending::class, function () {
            return Reportable::class;
        })
            ->shouldReceive('get')->once()->andReturn($reportData);

        $this->assertEquals($reportData, ReportFactory::generate('spending')->get());
    }

    public function test_it_returns_spending_by_category_report_data()
    {
        $reportData = [
            'report',
            'data',
        ];

        $this->mock(SpendingByCategory::class, function () {
            return Reportable::class;
        })
            ->shouldReceive('get')->once()->andReturn($reportData);

        $this->assertEquals($reportData, ReportFactory::generate('categorial')->get());
    }

    public function test_it_throws_an_exception_for_invalid_reports()
    {
        $this->expectException(InvalidArgumentException::class);

        ReportFactory::generate('');
    }
}
