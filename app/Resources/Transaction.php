<?php

namespace Bdgt\Resources;

use Bdgt\Resources\Model;

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
        'id',
        'user_id',
        'user',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'float',
    ];

    public function account()
    {
        return $this->belongsTo('Bdgt\Resources\Account');
    }

    public function category()
    {
        return $this->belongsTo('Bdgt\Resources\Category');
    }

    public function bill()
    {
        return $this->belongsTo('Bdgt\Resources\Bill');
    }
}
