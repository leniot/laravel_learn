<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/12
 * Time: 14:27
 */

use Illuminate\Database\Seeder;

class PoliciesTableSeeder extends Seeder
{
    /**
     * 填充初始数据
     */
    public function run()
    {
        $current_time = date('Y-m-d H:i:s', time());

        DB::table('policies')->delete();

        DB::table('policies')->insert([
            //permissions
            [
                'id' => 1,
                'identifier' => 'permissions_index_access',
                'name' => '权限管理',
                'desc' => '权限管理',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'id' => 2,
                'identifier' => 'permissions_create_access',
                'name' => '新增权限',
                'desc' => '新增权限',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'id' => 3,
                'identifier' => 'permissions_edit_access',
                'name' => '编辑权限',
                'desc' => '编辑权限',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'id' => 4,
                'identifier' => 'permissions_delete_access',
                'name' => '删除权限',
                'desc' => '删除权限',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            //policies
            [
                'id' => 5,
                'identifier' => 'policies_index_access',
                'name' => '权限策略管理',
                'desc' => '权限策略管理',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'id' => 6,
                'identifier' => 'policies_create_access',
                'name' => '新增权限策略',
                'desc' => '新增权限策略',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'id' => 7,
                'identifier' => 'policies_edit_access',
                'name' => '编辑权限策略',
                'desc' => '编辑权限',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'id' => 8,
                'identifier' => 'policies_delete_access',
                'name' => '删除权限策略',
                'desc' => '删除权限策略',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            //roles
            [
                'id' => 9,
                'identifier' => 'roles_index_access',
                'name' => '角色管理',
                'desc' => '角色管理',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'id' => 10,
                'identifier' => 'roles_create_access',
                'name' => '新增角色',
                'desc' => '新增角色',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'id' => 11,
                'identifier' => 'roles_edit_access',
                'name' => '编辑角色',
                'desc' => '编辑角色',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'id' => 12,
                'identifier' => 'roles_delete_access',
                'name' => '删除角色',
                'desc' => '删除角色',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            //administrators
            [
                'id' => 13,
                'identifier' => 'administrators_index_access',
                'name' => '用户（管理员）管理',
                'desc' => '用户（管理员）管理',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'id' => 14,
                'identifier' => 'administrators_create_access',
                'name' => '新增用户（管理员）',
                'desc' => '新增用户（管理员）',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'id' => 15,
                'identifier' => 'administrators_edit_access',
                'name' => '编辑用户（管理员）',
                'desc' => '编辑用户（管理员）',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'id' => 16,
                'identifier' => 'administrators_delete_access',
                'name' => '删除用户（管理员）',
                'desc' => '删除用户（管理员）',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
            //menus
            [
                'id' => 17,
                'identifier' => 'menus_index_access',
                'name' => '菜单管理',
                'desc' => '菜单管理',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'id' => 18,
                'identifier' => 'menus_create_access',
                'name' => '新增菜单',
                'desc' => '新增菜单',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'id' => 19,
                'identifier' => 'menus_edit_access',
                'name' => '编辑菜单',
                'desc' => '编辑菜单',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'id' => 20,
                'identifier' => 'menus_delete_access',
                'name' => '删除菜单',
                'desc' => '删除菜单',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
        ]);
    }
}