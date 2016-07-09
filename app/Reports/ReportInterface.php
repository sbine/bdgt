<?php

namespace Bdgt\Reports;

interface ReportInterface
{
    public function name();

    public function get($startDate = null, $endDate = null);
}
