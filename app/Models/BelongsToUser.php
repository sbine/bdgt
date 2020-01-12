<?php

namespace App\Models;

trait BelongsToUser
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
