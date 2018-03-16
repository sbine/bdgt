<?php

namespace Bdgt\Tenancy;

class TenancyObserver
{
    public function saving($model)
    {
        $model->{Tenant::COLUMN} = app(Tenant::class)->id();
    }
}
