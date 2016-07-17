<?php

use App\Thread;
use Illuminate\Database\Seeder;

class ThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('threads')->truncate();
        DB::table('posts')->truncate();
        DB::table('tag_thread')->truncate();

        $thread = Thread::create([
            'name' => 'Pokemon Go hit and it\'s insane',
            'link' => "http://www.pokemon.com/us/pokemon-video-games/pokemon-go/",
            'nsfw' => false,
            'user_id' => 1
        ]);
        $thread->posts()->create([
            'body' => 'Ran into like **30** people playing Pokémon Go when I was running around',
            'syntax' => 'm',
            'user_id' => 1
        ]);

        $thread = Thread::create([
            'name' => 'Check out these tentacles',
            'nsfw' => true,
            'user_id' => 1
        ]);
        $thread->posts()->create([
            'body' => 'Lol [b]JK[\b]',
            'syntax' => 'b',
            'user_id' => 1
        ]);
    }
}
