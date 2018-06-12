<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/12
 * Time: 15:04
 */

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $current_time = date('Y-m-d H:i:s', time());

        DB::table('roles')->delete();

        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => '超级管理员',
                'identifier' => 'administrator',
                'desc' => '超级管理员具有系统最高权限',
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ]
        ]);
    }
}