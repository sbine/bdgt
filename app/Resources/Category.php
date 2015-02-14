<?php namespace Bdgt\Resources;

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
    protected $fillable = ['label', 'parent_category_id',];

    public function transactions()
    {
        return $this->hasMany('Bdgt\Resources\Transaction');
    }
}
