<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip', 45);
            $table->timestamps();
        });

        Schema::create('ip_user', function(Blueprint $table){
            $table->integer('ip_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->primary(['ip_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ip_user');
        Schema::drop('ips');
    }
}
