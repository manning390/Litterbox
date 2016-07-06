<?php

use App\Enums\SyntaxType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name', 100);
            $table->string('link')->nullable();
            $table->enum('syntax', SyntaxType::getKeys());
            $table->boolean('nsfw');

            $table->timestamp('locked_at')->nullable();
            $table->timestamp('blocked_at')->nullable();
            $table->integer('blocked_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('thread_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->text('body');
            $table->softDeletes();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('thread_id')
                ->references('id')
                ->on('threads')
                ->onDelete('cascade');

            $table->foreign('parent_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name', 64);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('tag_thread', function (Blueprint $table) {
            $table->integer('tag_id')->unsigned();
            $table->integer('thread_id')->unsigned();

            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');

            $table->foreign('thread_id')
                ->references('id')
                ->on('threads')
                ->onDelete('cascade');

            $table->primary(['tag_id', 'thread_id']);
        });

        Schema::create('thread_likes', function (Blueprint $table) {
            $table->integer('thread_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('thread_id')
                ->references('id')
                ->on('threads')
                ->onDelete('cascade');

            $table->primary(['thread_id', 'user_id']);
        });

        Schema::create('polls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('thread_id')->unsigned();
            $table->string('question');
            $table->boolean('multiple');

            $table->timestamp('locked_at')->nullable();
            $table->timestamp('blocked_at')->nullable();
            $table->integer('blocked_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('thread_id')
                ->references('id')
                ->on('threads')
                ->onDelete('cascade');
        });

        Schema::create('poll_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('poll_id')->unsigned();
            $table->string('answer');
            $table->timestamps();

            $table->foreign('poll_id')
                ->references('id')
                ->on('polls')
                ->onDelete('cascade');
        });

        Schema::create('poll_submissions', function (Blueprint $table) {
            $table->integer('poll_id')->unsigned();
            $table->integer('poll_answer_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('poll_id')
                ->references('id')
                ->on('polls')
                ->onDelete('cascade');

            $table->foreign('poll_answer_id')
                ->references('id')
                ->on('poll_answers')
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
        Schema::drop('poll_submissions');
        Schema::drop('poll_answers');
        Schema::drop('polls');
        Schema::drop('thread_likes');
        Schema::drop('tag_thread');
        Schema::drop('tags');
        Schema::drop('posts');
        Schema::drop('threads');
    }
}
