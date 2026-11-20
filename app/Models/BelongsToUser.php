<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;

trait BelongsToUser
{
    protected static function bootBelongsToUser(): void
    {
        static::creating(function ($model) {
            if (Auth::check() && ! $model->user_id) {
                $model->user_id = Auth::id();
            }
        });
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
