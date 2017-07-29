<?php

namespace Bdgt\Services;

use InvalidArgumentException;
use Bdgt\Reports\Reportable;
use Bdgt\Reports\Spending;
use Bdgt\Reports\SpendingByCategory;

class ReportService
{
    public function generate(string $reportType): Reportable
    {
        switch ($reportType) {
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
