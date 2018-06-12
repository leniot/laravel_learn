<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/12
 * Time: 15:32
 */

use Illuminate\Database\Seeder;

class RoleMenusTableSeeder extends Seeder
{
    public function run()
    {
        $current_time = date('Y-m-d H:i:s', time());

        DB::table('role_menus')->delete();

        $allMenus = DB::table('menus')->get();

        $insertData = [];
        foreach ($allMenus as $menu) {
            $insertData[] = [
                'role_id' => 1,
                'menu_id' => $menu->id,
                'created_at' => $current_time,
                'updated_at' => $current_time,
            ];
        }

        DB::table('role_menus')->insert($insertData);
    }
}