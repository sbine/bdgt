<?php namespace Bdgt\Repositories\Eloquent;

use Bdgt\Repositories\Contracts\BillRepositoryInterface;
use Bdgt\Resources\Bill;

class EloquentBillRepository extends EloquentRepository implements BillRepositoryInterface
{

	public function __construct()
	{
		parent::__construct(new Bill);
	}

}