<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePolicies extends Model
{
    /**
     *  删除角色时更新角色-策略中间表
     * @param $role
     * @return mixed
     */
    public static function syncDelRole($role)
    {
        $result = self::where('role_id', $role)->delete();

        return $result;
    }

    /**
     * 删除策略时更新角色-策略中间表
     * @param $policy
     * @return mixed
     */
    public static function syncDelPolicy($policy)
    {
        $result = self::where('policy_id', $policy)->delete();

        return $result;
    }
}
