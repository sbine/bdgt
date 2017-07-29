<?php

namespace Bdgt\Reports;

interface Reportable
{
    public function name();

    public function get($startDate = null, $endDate = null);
}
