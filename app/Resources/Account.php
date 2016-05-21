<?php

namespace Bdgt\Resources;

use Bdgt\Resources\Model;

class Account extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_opened',
        'name',
        'balance',
        'interest',
        'interest_period',
        'user_id'
    ];

    public function getRunningBalanceAttribute()
    {
        $runningBalance = 0;
        foreach ($this->transactions()->get() as $transaction) {
            if ($transaction->inflow) {
                $runningBalance += $transaction->amount;
            } else {
                $runningBalance -= $transaction->amount;
            }
        }
        return $runningBalance;
    }

    public function transactions()
    {
        return $this->hasMany('Bdgt\Resources\Transaction');
    }
}
