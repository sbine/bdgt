<?php

namespace App\Reports;

interface Reportable
{
    public function name();

    public function forDateRange($startDate = null, $endDate = null);
}
