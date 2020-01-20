<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;

trait BelongsToUser
{
    public function __construct(array $attributes = [])
    {
        if (Auth::check() && ! array_key_exists('user_id', $attributes)) {
            $this->user_id = Auth::id();
        }

        parent::__construct($attributes);
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
