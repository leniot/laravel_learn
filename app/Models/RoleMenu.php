<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{

    /**
     * 同步角色删除操作
     * @param $role
     * @return mixed
     */
    public static function syncDelRole($role)
    {
        $result = self::where('role_id', $role)->delete();

        return $result;
    }

    /**
     * 同步菜单删除操作
     * @param $menu
     * @return mixed
     */
    public static function syncDelMenu($menu)
    {
        $result = self::where('menu_id', $menu)->delete();

        return $result;
    }
}
