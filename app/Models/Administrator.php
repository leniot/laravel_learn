<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

/**
 * Class Administrator
 * @package App\Models
 *
 */
class Administrator extends Model implements AuthenticatableContract
{
    use Authenticatable;

//    public function __construct(array $attributes = [])
//    {
//        $this->setTable('administrator');
//        parent::__construct($attributes);
//    }

    /**
     * @var array
     */
    protected $fillable = [
        'login_name', 'password'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * 管理员-角色多对多关联
     * @return BelongsToMany
     */
    public function roles() : BelongsToMany //返回类型声明
    {
        $pivotTable = 'role_administrators';

        $relatedModel = Role::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'administrator_id', 'role_id');
    }

    /**
     * 同步中间表
     * @param array $roles
     * @return array
     */
    public function updateRelation(array $roles)
    {
        return $this->roles()->sync($roles);
    }

    /**
     * 获取后台用户头像
     * @param $avatar
     * @return mixed
     */
    public function getAvatarAttribute($avatar)
    {
        if ($avatar) {
            return Storage::disk(config('admin.upload.disk'))->url($avatar);
        }

        return admin_asset('AdminLTE/dist/img/user2-160x160.jpg');
    }

    /**
     * 判断后台用户角色
     * @param string $role
     * @return bool
     */
    public function isRole(string $role) : bool
    {
        return $this->roles->pluck('identifier')->contains($role);
    }

    /**
     * 判断后台用户是否是超级管理员
     * @return bool
     */
    public function isAdministrator() : bool
    {
        return $this->isRole('administrator');
    }

    public function getPermissions()
    {
        $roles = $this->roles()->get();

        $policies = [];
        foreach ($roles as $role) {
            $policies = $role->policies()->get();
        }

        return $policies;
    }
}
