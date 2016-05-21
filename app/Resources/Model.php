<?php

namespace Bdgt\Resources;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    protected $nullable = [];

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
        foreach ($model->nullable as $field) {
            if ($model->{$field} === '') {
                $model->attributes[$field] = null;
            }
        }
    }
}
