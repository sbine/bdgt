<?php

namespace Bdgt\Resources;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

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
     * The attributes excluded from the model's JSON form.
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
