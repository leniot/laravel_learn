<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/12
 * Time: 15:08
 */

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    public function run()
    {
        $current_time = date('Y-m-d H:i:s', time());

        DB::table('menus')->delete();

        DB::table('menus')->insert([
            [
                'id' => 1,
                'pid' => '0',
                'title' => '系统设置',
                'icon' => 'fa fa-gear',
                'type' => 0,
                'uri' => '',
                'route' => '',
                'order' => 99,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'id' => 2,
                'pid' => 1,
                'title' => '权限管理',
                'icon' => 'fa fa-ban',
                'type' => 1,
                'uri' => 'auth/permissions',
                'route' => 'permissions.index',
                'order' => 1,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'id' => 3,
                'pid' => 1,
                'title' => '权限策略',
                'icon' => 'fa fa-toggle-on',
                'type' => 1,
                'uri' => 'auth/policies',
                'route' => 'policies.index',
                'order' => 2,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'id' => 4,
                'pid' => 1,
                'title' => '角色管理',
                'icon' => 'fa fa-group',
                'type' => 1,
                'uri' => 'auth/roles',
                'route' => 'roles.index',
                'order' => 3,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'id' => 5,
                'pid' => 1,
                'title' => '用户管理',
                'icon' => 'fa fa-user',
                'type' => 1,
                'uri' => 'auth/administrators',
                'route' => 'administrators.index',
                'order' => 4,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'id' => 6,
                'pid' => 1,
                'title' => '菜单管理',
                'icon' => 'fa fa-bars',
                'type' => 1,
                'uri' => 'auth/menus',
                'route' => 'menus.index',
                'order' => 5,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
        ]);
    }
}