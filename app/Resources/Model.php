<?php

namespace App\Resources;

use App\Tenancy\HasTenancy;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    use HasTenancy;

    protected $nullable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['user'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            self::setNullables($model);
        });
    }

    // http://laravel-tricks.com/tricks/setting-null-values-only-on-certain-fields
    protected static function setNullables($model)
    {
        array_map(function ($property) use ($model) {
            if ($model->{$property} === '') {
                $model->attributes[$property] = null;
            }
        }, $model->nullable);
    }
}
