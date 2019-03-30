<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\AccountRepositoryInterface;
use App\Resources\Account;

class EloquentAccountRepository extends EloquentRepository implements AccountRepositoryInterface
{
    public function __construct(Account $account)
    {
        parent::__construct($account);
    }
}
