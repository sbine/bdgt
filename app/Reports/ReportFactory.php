<?php

namespace App\Reports;

use InvalidArgumentException;

class ReportFactory
{
    public static function generate(string $reportType): Reportable
    {
        switch ($reportType) {
            case 'categorial':
                $report = app(SpendingByCategory::class);

                break;
            case 'spending':
                $report = app(Spending::class);

                break;
            default:
                throw new InvalidArgumentException('Invalid report type', 404);

                break;
        }

        return $report;
    }
}
