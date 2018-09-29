<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nickname', 'email', 'password', 'openid', 'type', 'last_login_time', 'login_times', 'access_token',
        'last_login_ip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 获取后台用户头像
     * @param $avatar
     * @return mixed
     */
    public function getAvatarAttribute($avatar)
    {
        //若设置了头像则直接返回头像url
        if ($avatar) {
            return Storage::disk('local')->url($avatar);
        }
        //未设置头像时返回默认
        return admin_asset('AdminLTE/dist/img/user2-160x160.jpg');
    }
}
