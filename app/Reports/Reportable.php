<?php

namespace Bdgt\Reports;

interface Reportable
{
    public function name();

    public function forDateRange($startDate = null, $endDate = null);
}
