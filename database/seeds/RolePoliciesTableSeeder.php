<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/12
 * Time: 15:32
 */

use Illuminate\Database\Seeder;

class RolePoliciesTableSeeder extends Seeder
{
    public function run()
    {
        $current_time = date('Y-m-d H:i:s', time());

        DB::table('role_policies')->delete();

        $allPolicies = DB::table('policies')->get();

        $insertData = [];
        foreach ($allPolicies as $policy) {
            $insertData[] = [
                'role_id' => 1,
                'policy_id' => $policy->id,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ];
        }

        DB::table('role_policies')->insert($insertData);
    }
}