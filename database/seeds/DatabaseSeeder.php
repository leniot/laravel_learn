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
        // $this->call(UsersTableSeeder::class);
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
