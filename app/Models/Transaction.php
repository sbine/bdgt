<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Transaction extends Model
{
    use HasFactory;

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
        'account_id' => 'int',
        'category_id' => 'int',
        'bill_id' => 'int',
    ];

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

    public function scopeForMonth($query, $date)
    {
        $query
            ->where('date', '>=', (new Carbon)->parse($date)->startOfMonth())
            ->where('date', '<=', (new Carbon)->parse($date)->endOfMonth());
    }

    public function scopeOrdered($query)
    {
        $query->orderByDesc('date');
    }
}
