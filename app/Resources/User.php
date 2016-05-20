<?php

namespace Bdgt\Resources;

use Bdgt\Resources\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function accounts()
    {
        return $this->hasMany('Bdgt\Resources\Account');
    }

    public function bills()
    {
        return $this->hasMany('Bdgt\Resources\Bill');
    }

    public function categories()
    {
        return $this->hasMany('Bdgt\Resources\Category');
    }

    public function goals()
    {
        return $this->hasMany('Bdgt\Resources\Goal');
    }

    public function transactions()
    {
        return $this->hasMany('Bdgt\Resources\Transaction');
    }
}
