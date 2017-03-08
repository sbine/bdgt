<?php

namespace Bdgt\Scopes;

use DomainException;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TenancyScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     * @throws DomainException
     */
    public function apply(Builder $builder, Model $model)
    {
        if (!Auth::check()) {
            throw new DomainException('Unable to apply tenancy scope: no authenticated user found');
        }
        $builder->where($model->getTable() . '.user_id', '=', Auth::user()->id);
    }
}
