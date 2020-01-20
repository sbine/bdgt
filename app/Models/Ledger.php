<?php

namespace App\Models;

class Ledger
{
    protected $transactions;
    protected $balance = 0.00;
    protected $totalOutflow = 0.00;
    protected $totalInflow = 0.00;
    protected $lastPurchase = 'N/A';

    public function __construct()
    {
        $this->transactions = Transaction::all()->sortByDesc('date');

        if (! $this->transactions->isEmpty()) {
            $this->lastPurchase = $this->transactions->first()->date;

            foreach ($this->transactions as $t) {
                if ($t->inflow) {
                    $this->totalInflow += $t->amount;
                } else {
                    $this->totalOutflow += $t->amount;
                }
            }
        }

        $this->balance = ($this->totalInflow - $this->totalOutflow);
    }

    public function transactions()
    {
        return $this->transactions;
    }

    public function balance()
    {
        return $this->balance;
    }

    public function totalInflow()
    {
        return $this->totalInflow;
    }

    public function totalOutflow()
    {
        return $this->totalOutflow;
    }

    public function lastPurchase()
    {
        return $this->lastPurchase;
    }
}
