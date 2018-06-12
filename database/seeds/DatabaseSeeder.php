<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(PoliciesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(AdministratorsTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(RoleAdministratorsTableSeeder::class);
        $this->call(PolicyPermissionsTableSeeder::class);
        $this->call(RolePoliciesTableSeeder::class);
        $this->call(RoleMenusTableSeeder::class);
//        DB::table('administrators')->insert(
//            [
//                'login_name' => 'admin',
//                'display_name' => '超级管理员',
//                'password' => bcrypt('123456'),
//                'created_at' => date('Y-m-d H:i:s', time()),
//                'updated_at' => date('Y-m-d H:i:s', time()),
//            ]
//        );
    }
}
