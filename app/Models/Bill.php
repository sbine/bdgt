<?php

namespace App\Models;

use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'bills';

    protected $fillable = [
        'label',
        'start_date',
        'frequency',
        'amount',
        'user_id',
    ];

    protected $casts = [
        'start_date' => 'date:Y-m-d',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class)->ordered();
    }

    public function getTotalAttribute()
    {
        return $this->transactions->sum(function ($transaction) {
            return (
                ! $transaction->inflow
                && $transaction->date > $this->lastDue
                && $transaction->date <= $this->nextDue
            )
                ? $transaction->amount
                : 0;
        });
    }

    public function getPaidAttribute()
    {
        if ($this->total >= $this->amount) {
            return true;
        }

        return false;
    }

    public function getDueDatesForInterval($intervalStart, $intervalEnd)
    {
        $intervalStart = new DateTime(date('Y-m-d', strtotime($intervalStart)));
        $intervalEnd = new DateTime(date('Y-m-d', strtotime($intervalEnd)));
        $initialStart = $this->start_date;
        $frequency = new DateInterval('P' . $this->frequency . 'D');

        $dates = [];
        $date = $initialStart;

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
        if (! $this->cachedNextDue) {
            $startDate = new DateTime(date('Y-m-d 23:59:59', strtotime($this->start_date)));
            $currentDate = new DateTime(date('Y-m-d'));
            $frequency = new DateInterval('P' . $this->frequency . 'D');

            $date = $startDate;

            while ($date <= $currentDate) {
                $date->add($frequency);
            }

            $this->cachedNextDue = $date->format('Y-m-d');
        }

        return $this->cachedNextDue;
    }

    public function getLastDueAttribute()
    {
        if (! $this->cachedLastDue) {
            $startDate = new DateTime(date('Y-m-d', strtotime($this->start_date)));
            $currentDate = new DateTime(date('Y-m-d'));
            $frequency = new DateInterval('P' . $this->frequency . 'D');

            $date = $startDate;

            while ($date <= $currentDate) {
                $date->add($frequency);
            }

            $this->cachedLastDue = $date->sub($frequency)->format('Y-m-d');
        }

        return $this->cachedLastDue;
    }
}
