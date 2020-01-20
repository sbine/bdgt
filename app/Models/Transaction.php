<?php

namespace App\Models;

use Illuminate\Support\Carbon;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'date',
        'account_id',
        'category_id',
        'bill_id',
        'payee',
        'amount',
        'inflow',
        'cleared',
        'flair',
        'user_id',
    ];

    protected $casts = [
        'date' => 'datetime',
        'amount' => 'float',
        'cleared' => 'bool',
        'inflow' => 'bool',
    ];

    /**
     * Explicitly parse provided datetime strings to avoid
     * the Carbon exception "Unexpected data found. Trailing data".
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse($value)->toDateTimeString();
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function scopeOrdered($query)
    {
        $query->orderByDesc('date');
    }
}
