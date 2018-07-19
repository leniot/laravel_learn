<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('文章标题');
            $table->mediumText('content')->comment('文章正文');
            $table->string('cover_image')->commont('封面图片');
            $table->integer('category_id')->default(0)->comment('分类id');
            $table->string('description')->default('')->comment('文章描述');
            $table->string('keywords')->default('')->comment('关键词');
            $table->tinyInteger('status')->default(0)->comment('状态：0未发布，1已发布，2审核中，3编辑中');
            $table->integer('author')->comment('作者');
            $table->tinyInteger('is_top')->comment('是否置顶');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
