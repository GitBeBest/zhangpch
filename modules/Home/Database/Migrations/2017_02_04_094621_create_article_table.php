<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('zpc_article', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title', 45); //文章标题
            $table->string('resume', 200); //文章简介
            $table->string('author', 45); //文章作者
            $table->text('content')->nullable(); //文章内容
            $table->integer('category')->default(0); //分类
            $table->integer('view_times')->default(0); //浏览次数
            $table->integer('comment_times')->default(0); //点评次数
            $table->integer('praise_times')->default(0);//点赞次数
            $table->integer('hate_times')->default(0);//鄙视次数
            $table->string('link_img', 100)->nullable(); //相关图片
            $table->integer('status')->default(0); //发布状态0未发布1发布
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
        Schema::drop('zpc_article');
    }

}
