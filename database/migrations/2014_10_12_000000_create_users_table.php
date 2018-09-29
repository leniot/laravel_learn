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
            $table->increments('id')->comment('自增id');
            $table->string('name')->unique()->comment('用户名');
            $table->string('nickname')->nullable()->comment('昵称');
            $table->string('password')->nullable()->comment('密码');
            $table->string('mobile')->unique()->nullable()->comment('手机号');
            $table->string('avatar')->nullable()->comment('头像');
            $table->string('email')->unique()->nullable()->comment('邮箱');
            $table->tinyInteger('status')->default(1)->comment('状态：0禁用，1启用');
            $table->tinyInteger('type')->default(0)->comment('用户类型 0：系统注册，1：微信，2：qq，3：github...');
            $table->string('openid')->nullable()->comment('第三方id');
            $table->string('access_token')->nullable()->comment('access_token');
            $table->integer('login_times')->comment('登录次数');
            $table->string('last_login_ip')->comment('最后登录ip');
            $table->timestamp('last_login_time')->comment('最后登录时间');
            $table->rememberToken();
            $table->softDeletes()->comment('软删除标记');
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
