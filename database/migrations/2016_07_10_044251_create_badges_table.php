<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label');
            $table->string('path');
            $table->timestamps();
        });

        Schema::create('badge_user', function (Blueprint $table) {
            $table->integer('badge_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('amount')->default(1);

            $table->foreign('badge_id')
                ->references('id')
                ->on('badges')
                ->onDelete('cascade');

            $table->primary(['badge_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('badge_user');
        Schema::drop('badges');
    }
}
