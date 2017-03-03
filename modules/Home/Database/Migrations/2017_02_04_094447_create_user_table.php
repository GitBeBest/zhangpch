<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zpc_user', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('username', 50)->nullable();
            $table->string('password', 12)->nullable();
            $table->string('open_id', 20)->nullable();
            $table->string('header_pic', 100)->nullable();
            $table->string('email', 55)->nullable();
            $table->string('sex', 4)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('telephone', 11)->nullable();
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
        Schema::drop('zpc_user');
    }

}
