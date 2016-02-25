<?php

namespace Bdgt\Resources;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label',
        'parent_category_id',
        'budgeted',
        'user_id'
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
        return $this->hasMany('Bdgt\Resources\Transaction');
    }
}
