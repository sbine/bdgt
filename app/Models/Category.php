<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

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
        if ($this->budgeted == 0) {
            // no progress with no budget
            return 0;
        }

        $percent = round(($this->spent / $this->budgeted) * 100);

        return $percent > 0 ? $percent : 0;
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
