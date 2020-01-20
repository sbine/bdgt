<?php

namespace App\Models;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'label',
        'parent_category_id',
        'budgeted',
        'user_id',
    ];

    public function getSpentAttribute()
    {
        $spent = 0;
        foreach ($this->transactions()->get() as $transaction) {
            if ($transaction->inflow) {
                $spent -= $transaction->amount;
            } else {
                $spent += $transaction->amount;
            }
        }

        return $spent;
    }

    public function getProgressAttribute()
    {
        return round(($this->spent / $this->budgeted) * 100);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
