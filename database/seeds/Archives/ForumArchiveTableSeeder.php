<?php

class PostArchive extends \Eloquent {
    protected $connection = 'cl_archive';
    protected $table = 'posts';

    public function link(){
        return $this->hasOne(LinkArchive::class, 'user_id');
    }

    public function isThread(){
        return $this->parent_id == null && $this->title != null;
    }
}

class LinkArchive extends \Eloquent {
    protected $connection = 'cl_archive';
    protected $table = 'links';

}

class PollArchive extends \Eloquent {
    protected $connection = 'cl_archive';
    protected $table = 'polls_questions';

    public answers(){
        return $this->hasMany(PollAnswersArchive);
    }
}

class PollAnswersArchive extends \Eloquent {
    protected $connection = 'cl_archive';
    protected $table = 'polls_answers';

    public function poll(){
        return $this->belongsTo(PollArchive);
    }
}

class PollSubmittionsArchive extends \Eloquent {
    protected $connection = 'cl_archive';
    protected $table = 'polls_users_answers';

    public function poll(){
        return $this->belongsTo(PollArchive);
    }
}

class ForumArchiveTableSeeder extends Seeder {
    public function run(){
        $mapping = [];
        $postData = PostArchive::all();
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table('threads')->truncate();
        DB::table('posts')->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        Eloquent::unguard();
        foreach ($postData as $post) {
            if($post->status == 3) continue;
            if($post->thread()){
                $thread = new App\Thread::create([
                    'id' => $post->id,
                    'user_id' => $post->user_id,
                    'title' => $post->title,
                    'locked_at' => $post->status == 1? Carbon::now() : null,
                    'blocked_at' => $post->status == 2? Carbon::now() : null,
                    'nsfw' => $post->meta->nsfw? true: false,
                    'link'=> $post->link != null? $post->link->url ? null,
                ]);
                $poll = PollArchive::where('id'=>$post->id);
                if($poll->exists()){
                    $poll = $poll->first();
                    $newpoll = $thread->poll()->create([
                        'question'=>$poll->question,
                        'multiple'=>$poll->options == 'multiple'? true : false,
                        'locked_at'=>$poll->options == 'closed'? Carbon::now() : null,
                    ]);
                    // $poll->answers;
                }
                $post->parent_id = $post->id;
            }
            $newpost = App\Thread::find($post->parent_id)->posts()->create([
                'user_id' => $post->user_id,
                'body' => $post->content,
                'syntax' => $post->content_syntax == 1? 'b' : 'm',
                'parent_id' => $post->in_reply_to_id != null? $mapping[$post->in_reply_to_id] : null,
            ]);
            $mapping[$post->id] = $newpost->id;
        }
    }
}