<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Sbine\Tenancy\HasTenancy;

class Model extends EloquentModel
{
    use HasTenancy, BelongsToUser;

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

    // https://laravel-tricks.com/tricks/setting-null-values-only-on-certain-fields
    protected static function setNullables($model)
    {
        array_map(function ($property) use ($model) {
            if ($model->{$property} === '') {
                $model->attributes[$property] = null;
            }
        }, $model->nullable);
    }
}
