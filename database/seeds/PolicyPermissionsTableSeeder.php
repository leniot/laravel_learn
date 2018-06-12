<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/12
 * Time: 15:34
 */

use Illuminate\Database\Seeder;

class PolicyPermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $current_time = date('Y-m-d H:i:s', time());

        DB::table('policy_permissions')->delete();

        DB::table('policy_permissions')->insert([
            [
                'policy_id' => 1,
                'permission_id' => 1,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 2,
                'permission_id' => 2,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 2,
                'permission_id' => 3,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 3,
                'permission_id' => 4,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 3,
                'permission_id' => 5,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 4,
                'permission_id' => 6,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 5,
                'permission_id' => 7,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 6,
                'permission_id' => 8,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 6,
                'permission_id' => 9,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 7,
                'permission_id' => 10,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 7,
                'permission_id' => 11,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 8,
                'permission_id' => 12,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 9,
                'permission_id' => 13,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 10,
                'permission_id' => 14,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 10,
                'permission_id' => 15,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 11,
                'permission_id' =>16,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 11,
                'permission_id' => 17,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 12,
                'permission_id' => 18,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 13,
                'permission_id' => 19,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 14,
                'permission_id' => 20,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 14,
                'permission_id' => 21,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 15,
                'permission_id' => 22,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 15,
                'permission_id' => 23,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 16,
                'permission_id' => 24,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 17,
                'permission_id' => 25,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 18,
                'permission_id' => 26,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 18,
                'permission_id' => 27,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 19,
                'permission_id' => 28,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 19,
                'permission_id' => 29,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],[
                'policy_id' => 20,
                'permission_id' => 30,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ],
        ]);
    }
}