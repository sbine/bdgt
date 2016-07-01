<?php

namespace Bdgt\Services;

use Exception;
use Bdgt\Reports\Spending;

class ReportService
{
    public function getName($type)
    {
        $report = $this->getReportForType($type);
        return $report->name();
    }

    public function get($type)
    {
        $report = $this->getReportForType($type);
        return $report->get();
    }

    private function getReportForType($type)
    {
        switch ($type) {
            case 'spending':
                $report = app()->make('Bdgt\Reports\Spending');
                break;
            default:
                throw new Exception('Invalid report type');
                break;
        }
        return $report;
    }
}
