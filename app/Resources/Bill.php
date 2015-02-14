<?php namespace Bdgt\Resources;

use Illuminate\Database\Eloquent\Model;

use DateTime;
use DateInterval;

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
    protected $fillable = ['label', 'start_date', 'frequency', 'amount'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id'];

    protected $appends = ['nextDue'];

    protected $transactions;

    public function addTransaction($transaction)
    {
        $this->transactions[] = $transaction;
        if ($transaction->inflow) {
            $this->total += $transaction->amount;
        } else {
            $this->total -= $transaction->amount;
        }
    }

    public function transactions()
    {
        return $this->hasMany('Bdgt\Resources\Transaction');
    }

    public function getNextDueAttribute()
    {
        $startDate = new DateTime($this->start_date);
        $currentDate = new DateTime(date('Y-m-d'));
        $frequency = new DateInterval('P' . $this->frequency . 'D');

        $date = $startDate;

        while ($date <= $currentDate) {
            $date->add($frequency);
        }

        return $date->format('Y-m-d');
    }
}
