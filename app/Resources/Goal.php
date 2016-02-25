<?php

namespace Bdgt\Resources;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'goals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label',
        'start_date',
        'goal_date',
        'balance',
        'amount',
        'user_id'
    ];

    protected $appends = [
        'achieved',
        'progress'
    ];

    public function getAchievedAttribute()
    {
        if ($this->balance >= $this->amount) {
            return true;
        }
        return false;
    }

    public function getProgressAttribute()
    {
        return sprintf('%0.0f', ($this->balance / $this->amount) * 100);
    }
}
