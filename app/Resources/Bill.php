<?php

namespace Bdgt\Resources;

use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bills';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label',
        'start_date',
        'frequency',
        'amount',
        'user_id'
    ];

    protected $appends = [
        'total',
        'nextDue',
        'lastDue',
        'paid'
    ];

    public function transactions()
    {
        return $this->hasMany('Bdgt\Resources\Transaction');
    }

    public function getTotalAttribute()
    {
        $total = 0;
        foreach ($this->transactions as $transaction) {
            if ($transaction->date > $this->lastDue && $transaction->date < $this->nextDue) {
                if (!$transaction->inflow) {
                    $total += $transaction->amount;
                }
            }
        }
        return $total;
    }

    public function getPaidAttribute()
    {
        if ($this->total >= $this->amount) {
            return true;
        }
        return false;
    }

    public function getDueDatesForInterval($intervalStart, $intervalEnd, $frequency, $initialStart)
    {
        $intervalStart = new DateTime(date('Y-m-d', strtotime($intervalStart)));
        $intervalEnd   = new DateTime(date('Y-m-d', strtotime($intervalEnd)));
        $initialStart  = new DateTime(date('Y-m-d', strtotime($initialStart)));
        $frequency     = new DateInterval('P' . $frequency . 'D');

        $dates = [];
        $date  = $initialStart;

        while ($date < $intervalStart) {
            $date->add($frequency);
        }

        while ($date <= $intervalEnd) {
            $dates[] = $date->format('Y-m-d');
            $date->add($frequency);
        }

        return $dates;
    }

    public function getNextDueAttribute()
    {
        $startDate = new DateTime(date('Y-m-d', strtotime($this->start_date)));
        $currentDate = new DateTime(date('Y-m-d'));
        $frequency = new DateInterval('P' . $this->frequency . 'D');

        $date = $startDate;

        while ($date <= $currentDate) {
            $date->add($frequency);
        }

        return $date->format('Y-m-d');
    }

    public function getLastDueAttribute()
    {
        $startDate = new DateTime(date('Y-m-d', strtotime($this->start_date)));
        $currentDate = new DateTime(date('Y-m-d'));
        $frequency = new DateInterval('P' . $this->frequency . 'D');

        $date = $startDate;

        while ($date <= $currentDate) {
            $date->add($frequency);
        }

        return $date->sub($frequency)->format('Y-m-d');
    }
}
