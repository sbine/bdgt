<?php

namespace App\Models;

use App\Models\Model;

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

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'float',
        'balance' => 'float',
    ];

    public function getAchievedAttribute(): bool
    {
        if ($this->balance >= $this->amount) {
            return true;
        }
        return false;
    }

    public function getProgressAttribute(): float
    {
        return sprintf('%0.0f', ($this->balance / $this->amount) * 100);
    }
}
