<?php

use App\Enums\BanType;
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
            $table->enum('type', BanType::getKeys());
            $table->json('meta');
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

        Schema::create('bannables', function(Blueprint $table){
            $table->integer('ban_id')->unsigned();
            $table->integer('bannable_id')->unsigned();
            $table->string('bannable_type');

            $table->foreign('ban_id')
                ->references('id')
                ->on('bans')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bannables');
        Schema::drop('actions');
        Schema::drop('bans');
    }
}
