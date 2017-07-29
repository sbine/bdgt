<?php

namespace Bdgt\Reports;

use InvalidArgumentException;

class ReportFactory
{
    public static function generate(string $reportType): Reportable
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
