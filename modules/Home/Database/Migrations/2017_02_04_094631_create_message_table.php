<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zpc_message', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id'); //用户id
            $table->string('message', 255); //评论内容
            $table->integer('art_id'); //文章id
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
        Schema::drop('zpc_message');
    }

}
