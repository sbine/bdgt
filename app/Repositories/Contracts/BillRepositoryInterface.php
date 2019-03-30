<?php

namespace App\Repositories\Contracts;

use App\Resources\Bill;

interface BillRepositoryInterface extends RepositoryInterface
{
    public function allForInterval($intervalStart, $intervalEnd);
}
