<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;

trait BelongsToUser
{
    protected function initializeBelongsToUser(): void
    {
        if (Auth::check() && ! $this->user_id) {
            $this->user_id = Auth::id();
        }
    }

    protected function getArrayableItems(array $values)
    {
        if (! in_array('user', $this->hidden)) {
            $this->hidden[] = 'user';
        }

        return parent::getArrayableItems($values);
    }

    public function getCasts()
    {
        return array_merge([
            'user_id' => 'integer',
        ], parent::getCasts());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
