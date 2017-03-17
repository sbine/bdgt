<?php

namespace Bdgt\Services;

use InvalidArgumentException;
use Bdgt\Reports\ReportInterface;
use Bdgt\Reports\Spending;
use Bdgt\Reports\SpendingByCategory;

class ReportService
{
    private $report;

    public function __construct(string $reportType)
    {
        $this->report = $this->getReportForType($reportType);
    }

    public function getReportName()
    {
        return $this->report->name();
    }

    public function get($startDate = null, $endDate = null)
    {
        return $this->report->get($startDate, $endDate);
    }

    private function getReportForType($type): ReportInterface
    {
        switch ($type) {
            case 'categorial':
                $report = app()->make(SpendingByCategory::class);
                break;
            case 'spending':
                $report = app()->make(Spending::class);
                break;
            default:
                throw new InvalidArgumentException('Invalid report type');
                break;
        }
        return $report;
    }
}
