<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthTokenTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zpc_auth_token', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('openid', 30)->nullable();
            $table->string('access_token', 155)->nullable();
            $table->integer('expires_in')->default(7200);
            $table->string('refresh_token', 155)->nullable();
            $table->string('scope', 20)->default('snsapi_base');
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
        Schema::drop('zpc_auth_token');
    }

}
