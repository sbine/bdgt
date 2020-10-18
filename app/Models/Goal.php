<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Goal extends Model
{
    use HasFactory;

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
        return sprintf(
            '%0.0f',
            min(($this->balance / $this->amount) * 100, 100)
        );
    }
}
