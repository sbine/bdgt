<?php

namespace App\Models;

class Goal extends Model
{
    protected $table = 'goals';

    protected $fillable = [
        'label',
        'start_date',
        'goal_date',
        'balance',
        'amount',
        'user_id',
    ];

    protected $casts = [
        'amount' => 'float',
        'balance' => 'float',
        'goal_date' => 'date',
    ];

    public function getAchievedAttribute(): bool
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
