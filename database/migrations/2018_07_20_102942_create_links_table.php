<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id')->comment('自增id');
            $table->string('name')->unique()->comment('名称');
            $table->string('site_address')->unique()->comment('web地址');
            $table->string('logo')->comment('链接图标')->nullable();
            $table->string('category_id')->comment('链接分类');
            $table->integer('sort')->comment('排序');
            $table->tinyInteger('status')->comment('状态：0禁用，1启用');
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
        Schema::dropIfExists('links');
    }
}
