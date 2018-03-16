<?php

namespace Bdgt\Tenancy;

use Illuminate\Support\Facades\Auth;

class TenancyObserver
{
    public function saving($model)
    {
        $model->user_id = Auth::user()->id;
    }
}
