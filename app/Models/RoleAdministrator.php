<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleAdministrator extends Model
{
    /**
     * 同步角色删除操作
     * @param int $role
     * @return mixed
     */
    public static function syncDelRole($role)
    {
        $result = self::where('role_id', $role)->delete();

        return $result;
    }

    /**
     * 同步用户删除操作
     * @param $administrator
     * @return mixed
     */
    public static function syncDelAdministrator($administrator)
    {
        $result = self::where('administrator_id', $administrator)->delete();

        return $result;
    }
}
