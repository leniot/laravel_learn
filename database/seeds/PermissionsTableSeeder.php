<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/12
 * Time: 14:00
 */

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * 填充初始数据
     */
    public function run()
    {
        $current_time = date('Y-m-d H:i:s', time());

        DB::table('permissions')->delete();

        DB::table('permissions')->insert([
            //home
            [
                'id' => 1,
                'route' => 'home.index',
                'method' => 'GET',
                'desc' => '系统主页',
                'type' => 1,
                'created_at' => $current_time,
                'updated_at' => $current_time
            ],
            //permissions
            [
                'id' => 2,
                'route' => 'permissions.index',
                'method' => 'GET',
                'desc' => '权限管理',
                'type' => 1,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 3,
                'route' => 'permissions.create',
                'method' => 'GET',
                'desc' => '权限新增表单',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 4,
                'route' => 'permissions.store',
                'method' => 'POST',
                'desc' => '保存权限',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 5,
                'route' => 'permissions.edit',
                'method' => 'GET',
                'desc' => '权限编辑表单',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 6,
                'route' => 'permissions.update',
                'method' => 'PUT/PATCH',
                'desc' => '更新权限',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 7,
                'route' => 'permissions.destroy',
                'method' => 'DELETE',
                'desc' => '删除权限',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],
            //policies
            [
                'id' => 8,
                'route' => 'policies.index',
                'method' => 'GET',
                'desc' => '权限策略管理',
                'type' => 1,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 9,
                'route' => 'policies.create',
                'method' => 'GET',
                'desc' => '权限策略新增表单',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 10,
                'route' => 'policies.store',
                'method' => 'POST',
                'desc' => '保存权限策略',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 11,
                'route' => 'policies.edit',
                'method' => 'GET',
                'desc' => '权限策略编辑表单',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 12,
                'route' => 'policies.update',
                'method' => 'PUT/PATCH',
                'desc' => '更新权限策略',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 13,
                'route' => 'policies.destroy',
                'method' => 'DELETE',
                'desc' => '删除权限策略',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],
            //roles
            [
                'id' => 14,
                'route' => 'roles.index',
                'method' => 'GET',
                'desc' => '角色管理',
                'type' => 1,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 15,
                'route' => 'roles.create',
                'method' => 'GET',
                'desc' => '角色新增表单',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 16,
                'route' => 'roles.store',
                'method' => 'POST',
                'desc' => '保存角色',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 17,
                'route' => 'roles.edit',
                'method' => 'GET',
                'desc' => '角色编辑表单',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 18,
                'route' => 'roles.update',
                'method' => 'PUT/PATCH',
                'desc' => '更新角色',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 19,
                'route' => 'roles.destroy',
                'method' => 'DELETE',
                'desc' => '删除角色',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],
            //administrators
            [
                'id' => 20,
                'route' => 'administrators.index',
                'method' => 'GET',
                'desc' => '用户管理',
                'type' => 1,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 21,
                'route' => 'administrators.create',
                'method' => 'GET',
                'desc' => '用户新增表单',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 22,
                'route' => 'administrators.store',
                'method' => 'POST',
                'desc' => '保存用户',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 23,
                'route' => 'administrators.edit',
                'method' => 'GET',
                'desc' => '用户编辑表单',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 24,
                'route' => 'administrators.update',
                'method' => 'PUT/PATCH',
                'desc' => '更新用户',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 25,
                'route' => 'administrators.destroy',
                'method' => 'DELETE',
                'desc' => '删除用户',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],
            //menus
            [
                'id' => 26,
                'route' => 'menus.index',
                'method' => 'GET',
                'desc' => '菜单管理',
                'type' => 1,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 27,
                'route' => 'menus.create',
                'method' => 'GET',
                'desc' => '菜单新增表单',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 28,
                'route' => 'menus.store',
                'method' => 'POST',
                'desc' => '保存菜单',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 29,
                'route' => 'menus.edit',
                'method' => 'GET',
                'desc' => '菜单编辑表单',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 30,
                'route' => 'menus.update',
                'method' => 'PUT/PATCH',
                'desc' => '更新菜单',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 31,
                'route' => 'menus.destroy',
                'method' => 'DELETE',
                'desc' => '删除菜单',
                'type' => 0,
                'created_at' => $current_time,
                'updated_at' => $current_time
            ],

        ]);
    }
}