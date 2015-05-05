<?php namespace Bdgt\Repositories\Eloquent;

use Bdgt\Repositories\Contracts\AccountRepositoryInterface;
use Bdgt\Resources\Account;

class EloquentAccountRepository extends EloquentRepository implements AccountRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new Account);
    }
}
