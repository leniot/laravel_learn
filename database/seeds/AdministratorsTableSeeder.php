<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/12
 * Time: 15:11
 */

use Illuminate\Database\Seeder;

class AdministratorsTableSeeder extends Seeder
{
    public function run()
    {
        $current_time = date('Y-m-d H:i:s', time());

        DB::table('administrators')->delete();

        DB::table('administrators')->insert([
            [
                'id' => 1,
                'login_name' => 'admin',
                'display_name' => '超级管理员',
                'password' => bcrypt('123456'),
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ]
        ]);
    }
}