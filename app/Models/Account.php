<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory;

    protected $table = 'accounts';

    protected $fillable = [
        'date_opened',
        'name',
        'balance',
        'interest',
        'interest_period',
        'user_id',
    ];

    protected $casts = [
        'date_opened' => 'datetime',
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
        return $this->hasMany(Transaction::class);
    }
}
