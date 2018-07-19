<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommontsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commonts', function (Blueprint $table) {
            $table->increments('id')->comment('自增id');
            $table->integer('article_id')->comment('文章id');
            $table->integer('pid')->conment('父级id');
            $table->text('content')->comment('评论内容');
            $table->tinyInteger('status')->comment('评论状态：0未审核，1审核通过，2审核不通过');
            $table->integer('user_id')->comment('用户id');
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
        Schema::dropIfExists('commonts');
    }
}
