<?php

namespace Bdgt\Repositories\Contracts;

use Bdgt\Resources\Bill;

interface BillRepositoryInterface extends RepositoryInterface
{
    public function allForInterval($intervalStart, $intervalEnd);
}
