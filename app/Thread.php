<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends Model
{

    use Lockable;
    use SoftDeletes {
        restore as baseRestore;
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'locked_at', 'blocked_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'link', 'nsfw', 'user_id'
    ];

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 20;

    /**
     * The table likes are stored in
     *
     * @var string
     */
    private static $likes_table = 'thread_likes';

    /**
     * Many Threads are created by Users
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Many Posts are created by Users
     */
    public function posts(){
        return $this->hasMany(Post::class);
    }

    /**
     * Posts that are replies to the Thread
     */
    public function rootPosts(){
        return $this->posts()->doesntHave('parent');
    }

    /**
     * Posts that are replies to Posts
     */
    public function childPosts(){
        return $this->posts()->has('parent');
    }

    /**
     * A Thread can have one Poll
     */
    public function poll(){
        return $this->hasOne(Poll::class);
    }

    /**
     * Many Threads can have many Tags
     */
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    /**
     * A Thread can be liked by the Auth'd User
     */
    public function like(){
        return DB::table(self::$likes_table)->insert(['thread_id' => $this->id, 'user_id' => Auth::user()->id]);
    }

    /**
     * A Thread can be unliked by the Auth'd User
     */
    public function unlike(){
        return DB::table(self::$likes_table)->where('thread_id', $this->id)->where('user_id', Auth::user()->id)->delete();
    }

    /**
     * Helper method to toggle Liking a Thread
     */
    public function toggleLike(){
        if(DB::table(self::$likes_table)->where('thread_id', $this->id)->where('user_id', Auth::user()->id)->count() > 0){
            return $this->unlike();
        }else{
            return $this->like();
        }
    }

    /**
     * A Thread can be pinned
     */
    public function pin(){
        return $this->update(['pinned_at'=>Carbon::now()]);
    }

    /**
     * A Thread can be unpinned
     */
    public function unpin(){
        return $this->update(['pinned_at'=>NULL]);
    }

    /**
     * Helper method to toggle Pinning a Thread
     */
    public function togglePin(){
        return $this->pinned ? $this->unpin() : $this->pin();
    }

    /**
     * Override to update who deleted a Thread
     */
    public function delete(){
        $this->update(['deleted_by' => Auth::user()->id]);
        return parent::delete();
    }

    /**
     * Override to reset who deleted a Thread
     */
    public function restore(){
        $this->update(['deleted_by' => NULL]);
        return $this->baseRestore();
    }

    /**
     * The total likes a Thread has
     *
     * @return int
     */
    public function getLikesAttribute(){
        return DB::table($likes_table)->where('thread_id', $this->id)->count();
    }

    /**
     * If a Thread is pinned or not
     *
     * @return bool
     */
    public function getPinnedAttribute(){
        return $this->pinned_at != NULL;
    }

}
