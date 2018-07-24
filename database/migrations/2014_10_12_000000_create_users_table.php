<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->comment('用户名');
            $table->string('name')->unique()->comment('用户名');
            $table->string('nickname')->nullable()->comment('昵称');
            $table->string('password')->comment('密码');
            $table->string('mobile')->unique()->nullable()->comment('手机号');
            $table->string('avatar')->nullable()->comment('头像');
            $table->string('email')->unique()->nullable()->comment('邮箱');
            $table->tinyInteger('status')->default(1)->comment('状态：0禁用，1启用');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
