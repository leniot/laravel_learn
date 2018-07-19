<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/12
 * Time: 15:33
 */

use Illuminate\Database\Seeder;

class RoleAdministratorsTableSeeder extends Seeder
{
    public function run()
    {
        $current_time = date('Y-m-d H:i:s');

        DB::table('role_administrators')->delete();

        DB::table('role_administrators')->insert([
            [
                'role_id' => 1,
                'administrator_id' => 1,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
        ]);
    }
}