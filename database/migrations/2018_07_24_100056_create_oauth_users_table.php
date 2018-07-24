<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOauthUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oauth_users', function (Blueprint $table) {
            $table->increments('id')->comment('自增id');
            $table->unsignedTinyInteger('type')->comment('用户类型：1QQ，2微信...');
            $table->string('openid')->comment('第三方用户id');
            $table->string('name')->comment('第三方用户名');
            $table->string('nickname')->comment('昵称');
            $table->string('avatar')->comment('头像');
            $table->string('mobile')->nullable()->comment('手机号');
            $table->string('email')->nullable()->comment('邮箱');
            $table->string('last_login_ip', 16)->comment('最后登录ip');
            $table->timestamp('last_login_time')->comment('最后登录时间');
            $table->unsignedInteger('login_times')->comment('登录次数');
            $table->unsignedTinyInteger('status')->comment('状态：0禁用，1启用');
            $table->string('access_token')->comment('access_token');
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
        Schema::dropIfExists('oauth_users');
    }
}
