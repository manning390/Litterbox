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

    protected $fillable = ['name', 'link', 'nsfw', 'user_id'];

    protected $perPage = 20;

    private static $likes_table = 'thread_likes';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function poll(){
        return $this->hasOne(Poll::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function like(User $user = NULL){
        $user = $user ?? Auth::user();
        return DB::table(self::$likes_table)->insert(['thread_id' => $this->id, 'user_id' => $user->id]);
    }

    public function unlike(User $user = NULL){
        $user = $user ?? Auth::user();
        return DB::table(self::$likes_table)->where('thread_id', $this->id)->where('user_id', $user->id)->delete();
    }

    public function toggleLike(User $user = NULL){
        $user = $user ?? Auth::user();
        if(DB::table(self::$likes_table)->where('thread_id', $this->id)->where('user_id', $user->id)->count() > 0){
            return $this->unlike($user);
        }else{
            return $this->like($user);
        }
    }

    public function pin(){
        return DB::table(self::$pin_table)->insert(['thread_id' => $this->id, 'user_id' => Auth::user()->id]);
    }

    public function unpin(){
        return DB::table(self::$pin_table)->delete(['thread_id' => $this->id]);
    }

    public function delete(){
        $this->update(['deleted_by' => Auth::user()->id]);
        return parent::delete();
    }

    public function restore(){
        $this->update(['deleted_by' => NULL]);
        return $this->baseRestore();
    }

    public function getLikesAttribute(){
        return DB::table($likes_table)->where('thread_id', $this->id)->count();
    }

}
