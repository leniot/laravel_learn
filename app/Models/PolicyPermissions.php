<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PolicyPermissions extends Model
{
    /**
     * 删除权限路由时同步中间表
     * @param $permission
     * @return mixed
     */
    public static function syncDelPermission($permission)
    {
        $result = self::where('permission_id', $permission)->delete();

        return $result;
    }

    /**
     * 删除权限策略时同步中间表
     * @param $policy
     * @return mixed
     */
    public static function syncDelPolicy($policy)
    {
        $result= self::where('policy_id', $policy)->delete();

        return $result;
    }
}
