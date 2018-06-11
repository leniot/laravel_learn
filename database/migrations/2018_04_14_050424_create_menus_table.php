<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('自增id');
            $table->integer('pid')->default(0)->comment('父级id');
            $table->string('title', 50)->comment('菜单标题');
            $table->string('icon', 50)->comment('图标');
            $table->string('type', 50)->default(0)->comment('图标:0节点，uri');
            $table->string('uri', 100)->nullable()->comment('路径');
            $table->string('route')->nullable()->comment('路由');
            $table->integer('order')->default(0)->comment('排序号');
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
        Schema::dropIfExists('menus');
    }
}
