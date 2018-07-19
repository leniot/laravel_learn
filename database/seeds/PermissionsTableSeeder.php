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
            //home 系统主页
            [
                'id' => 1,
                'route' => 'home.index',
                'method' => 'GET',
                'desc' => '系统主页',
                'created_at' => $current_time,
                'updated_at' => $current_time
            ],
            //permissions 权限路由
            [
                'id' => 2,
                'route' => 'permissions.index',
                'method' => 'GET',
                'desc' => '权限路由',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 3,
                'route' => 'permissions.create',
                'method' => 'GET',
                'desc' => '权限路由新增表单',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 4,
                'route' => 'permissions.store',
                'method' => 'POST',
                'desc' => '保存权限路由',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 5,
                'route' => 'permissions.edit',
                'method' => 'GET',
                'desc' => '权限路由编辑表单',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 6,
                'route' => 'permissions.update',
                'method' => 'PUT/PATCH',
                'desc' => '更新权限路由',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 7,
                'route' => 'permissions.destroy',
                'method' => 'DELETE',
                'desc' => '删除权限路由',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],
            //policies 权限策略
            [
                'id' => 8,
                'route' => 'policies.index',
                'method' => 'GET',
                'desc' => '权限策略管理',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 9,
                'route' => 'policies.create',
                'method' => 'GET',
                'desc' => '权限策略新增表单',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 10,
                'route' => 'policies.store',
                'method' => 'POST',
                'desc' => '保存权限策略',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 11,
                'route' => 'policies.edit',
                'method' => 'GET',
                'desc' => '权限策略编辑表单',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 12,
                'route' => 'policies.update',
                'method' => 'PUT/PATCH',
                'desc' => '更新权限策略',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 13,
                'route' => 'policies.destroy',
                'method' => 'DELETE',
                'desc' => '删除权限策略',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],
            //menus 菜单
            [
                'id' => 14,
                'route' => 'menus.index',
                'method' => 'GET',
                'desc' => '菜单管理',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 15,
                'route' => 'menus.create',
                'method' => 'GET',
                'desc' => '菜单新增表单',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 16,
                'route' => 'menus.store',
                'method' => 'POST',
                'desc' => '保存菜单',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 17,
                'route' => 'menus.edit',
                'method' => 'GET',
                'desc' => '菜单编辑表单',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 18,
                'route' => 'menus.update',
                'method' => 'PUT/PATCH',
                'desc' => '更新菜单',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 19,
                'route' => 'menus.destroy',
                'method' => 'DELETE',
                'desc' => '删除菜单',
                'created_at' => $current_time,
                'updated_at' => $current_time
            ],
            //roles 角色管理
            [
                'id' => 20,
                'route' => 'roles.index',
                'method' => 'GET',
                'desc' => '角色管理',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 21,
                'route' => 'roles.create',
                'method' => 'GET',
                'desc' => '角色新增表单',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 22,
                'route' => 'roles.store',
                'method' => 'POST',
                'desc' => '保存角色',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 23,
                'route' => 'roles.edit',
                'method' => 'GET',
                'desc' => '角色编辑表单',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 24,
                'route' => 'roles.update',
                'method' => 'PUT/PATCH',
                'desc' => '更新角色',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 25,
                'route' => 'roles.destroy',
                'method' => 'DELETE',
                'desc' => '删除角色',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],
            //administrators （用户）管理员
            [
                'id' => 26,
                'route' => 'administrators.index',
                'method' => 'GET',
                'desc' => '用户管理',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 27,
                'route' => 'administrators.create',
                'method' => 'GET',
                'desc' => '用户新增表单',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 28,
                'route' => 'administrators.store',
                'method' => 'POST',
                'desc' => '保存用户',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 29,
                'route' => 'administrators.edit',
                'method' => 'GET',
                'desc' => '用户编辑表单',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 30,
                'route' => 'administrators.update',
                'method' => 'PUT/PATCH',
                'desc' => '更新用户',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],[
                'id' => 31,
                'route' => 'administrators.destroy',
                'method' => 'DELETE',
                'desc' => '删除用户',
                'created_at' => $current_time,
                'updated_at' => $current_time

            ],

        ]);
    }
}