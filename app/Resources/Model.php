<?php

namespace Bdgt\Resources;

use Bdgt\Scopes\TenancyScope;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    protected $nullable = [];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TenancyScope);
        static::observe(new TenancyObserver);

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
