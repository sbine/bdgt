<?php namespace Bdgt\Resources;

use Illuminate\Database\Eloquent\Model;

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
    protected $fillable = ['date', 'payee', 'amount', 'cleared'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id'];

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
