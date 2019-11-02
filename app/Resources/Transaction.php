<?php

namespace App\Resources;

use App\Resources\Model;
use Illuminate\Support\Carbon;

class Transaction extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    /**
     * The attributes that accept null as a value.
     *
     * @var array
     */
    protected $nullable = [
        'bill_id',
        'category_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
        'user',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'date' => 'datetime',
        'amount' => 'float',
        'cleared' => 'bool',
        'inflow' => 'bool',
    ];

    /**
     * Explicitly parse provided datetime strings to avoid
     * the Carbon exception "Unexpected data found. Trailing data"
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
