<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public function user_role()
    {
        return $this->hasOne('App\RoleUserModel', 'id', 'role');
    }


    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getPhoneAttribute($value)
    {

        return $this->attributes['phone'] =
            "+" .
            substr($value, 0, 1) . "(" .
            substr($value, 1, 3) . ")" .
            substr($value, 4, 3) . "-" .
            substr($value, 7, 2) . "-" .
            substr($value, 9, 2);
    }

}
