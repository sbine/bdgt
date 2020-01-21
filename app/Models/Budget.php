<?php

namespace App\Models;

use Illuminate\Support\Carbon;

class Budget extends Model
{
    use HasCompositeKey;

    public $incrementing = false;

    protected $table = 'budgets';

    protected $primaryKey = [
        'year',
        'month',
        'category_id',
        'user_id',
    ];

    protected $fillable = [
        'year',
        'month',
        'category_id',
        'budgeted',
        'spent',
        'balance',
        'user_id',
    ];

    protected $hidden = [
        'category',
    ];

    protected $casts = [
        'budgeted' => 'float',
        'spent' => 'float',
        'balance' => 'float',
    ];

    public function getDateAttribute()
    {
        return Carbon::parse($this->year . '-' . $this->month . '-15');
    }

    public function getSpentAttribute()
    {
        if (! $this->category || ! $this->category->transactions()->exists()) {
            return 0;
        }

        $total = 0;
        foreach ($this->category->transactions()->forMonth($this->date)->get() as $transaction) {
            if (! $transaction->inflow) {
                $total += $transaction->amount;
            }
        }

        $this->spent = $total;

        return $total;
    }

    public function setBudgetedAttribute($value)
    {
        $this->attributes['budgeted'] = $value;
        $this->attributes['balance'] = $value - $this->spent;
    }

    public function setSpentAttribute($value)
    {
        $this->attributes['spent'] = $value;
        $this->attributes['balance'] = $this->budgeted - $value;
    }

    public function scopeForDate($query, $year, $month)
    {
        $query->where('year', $year)
            ->where('month', $month);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
