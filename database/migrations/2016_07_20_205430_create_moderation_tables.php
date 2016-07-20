<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModerationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bans', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('expires')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('actions', function(Blueprint $table){
            $table->increments('id');
            $table->integer('ban_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->text('body');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('bannable', function(Blueprint $table){
            $table->integer('ban_id')->unsigned();
            $table->integer('bannable_id')->unsigned();
            $table->enum('type', BanType::getKeys());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bannable');
        Schema::drop('actions');
        Schema::drop('bans');
    }
}
