<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $fillable = [
        'login_name', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];
}
