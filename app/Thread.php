<?php

namespace App;

use Auth;
use App\Enums\PointType;
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
    protected $dates = [
        'deleted_at', 'locked_at', 'blocked_at'
    ];

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
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot(){
        parent::boot();
        // Add the NSFW filter on all queries
        static::addGlobalScope('nsfw', function(Builder $builder){
            $builder->where(function($query){
                $query->where('nsfw', Auth::user()->nsfw)
                    ->orWhere('nsfw', false);
            });
        });
    }

    /**
     * Save a new Thread with related models and return the instance.
     *
     * @param array $attributes
     * @return static
     */
    public static function createWithPost(array $attributes = []){
        $thread = self::create($attributes)->associate(Auth::user());
        $thread->posts()->create($attributes)->associate(Auth::user());
        $thread->associateUser(Auth::user());
        return $thread;
    }

    // /**
    //  * Update the model in the database.
    //  *
    //  * @param array $attributes
    //  * @param array $options
    //  * @return bool|int
    //  */
    // public function update(array $attributes = [], array $options = []){
    //     return parent::update($attributes, $options) &&
    //         $this->posts()->first()->update($attributes, $options);
    // }

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
     * Sets the User of Thread and Post
     * @param  User   $user
     * @return Thread
     */
    public function associateUser(User $user){
        $user->addPoints(PointType::Thread);
        $this->associate($user)->like();
        $this->posts()->first()->associate($user);
        return $this;
    }

    /**
     * A Thread can be liked by the Auth'd User
     */
    public function like(){
        if(!Auth::user()->owns($thread)) Auth::user()->addPoints(PointType::Like);
        return DB::table(self::$likes_table)->insert(['thread_id' => $this->id, 'user_id' => Auth::user()->id]);
    }

    /**
     * A Thread can be unliked by the Auth'd User
     */
    public function unlike(){
        if(!Auth::user()->owns($thread)) Auth::user()->minusPoints(PointType::Like);
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

    public function getPopularityAttribute(){
        $score = $this->likes > 1 ? $this->likes : 1;
        $posts = $this->posts()->count();
        $views = $this->views;
        return (log($views, self::$viewLogDecay) * 4 + (($posts * $score) / 5));
    }
}
