<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Sbine\Tenancy\HasTenancy;

class Model extends EloquentModel
{
    use HasTenancy, BelongsToUser;
}
