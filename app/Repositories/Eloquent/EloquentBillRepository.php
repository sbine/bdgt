<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BillRepositoryInterface;
use App\Resources\Bill;
use DateInterval;
use DateTime;

class EloquentBillRepository extends EloquentRepository implements BillRepositoryInterface
{
    public function __construct(Bill $bill)
    {
        parent::__construct($bill);
    }

    public function allForInterval($intervalStart, $intervalEnd)
    {
        $bills = $this->all();

        $intervalStart = new DateTime(date('Y-m-d', strtotime($intervalStart)));
        $intervalEnd   = new DateTime(date('Y-m-d', strtotime($intervalEnd)));

        return $bills->map(function ($bill, $key) use ($intervalStart, $intervalEnd) {
            $initialStart  = new DateTime(date('Y-m-d', strtotime($bill->start_date)));
            $frequency     = new DateInterval('P' . $bill->frequency . 'D');

            $date  = $initialStart;
            $instances = collect([]);

            while ($date < $intervalStart) {
                $date->add($frequency);
            }

            while ($date <= $intervalEnd) {
                $b = $bill->replicate();
                $b->id = $bill->id;
                $b->transactions = $bill->transactions;
                $b->start_date = $date->format('Y-m-d');
                $lastDue = clone $date;
                $b->cachedLastDue = $lastDue->sub($frequency)->format('Y-m-d');
                unset($b->user_id);
                $instances->push($b);
                $date->add($frequency);
            }

            return $instances;
        })->flatten();
    }
}
