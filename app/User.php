<?php

namespace App;

use DB;
use App\Enums\PointType;
use App\Enums\SyntaxType;
use Eloquent\Dialect\Json;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Json;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'options',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     *
     */
    protected $dates = [
        'deleted_at', 'login_at'
    ];

    /**
     * The columns that should be parsed for json.
     *
     * @var array
     */
    protected $jsonColumns = ['options'];

    /**
     * The path to the folder avys are saved
     */
    protected $avatarPath = 'img/avys';

    /**
     * The default photo if an avatar isn't set
     */
    protected $defaultAvatar = 'no_avatar.gif';

    /**
     * The default structure of the options json.
     *
     * @var array
     */
    protected $jsonStructure = [
        'avatar' => '',
        'color' => '#222223',
        'syntax' => SyntaxType::Markdown,
        'nsfw' => false,
        'mentionsEmail' => true,
        'pmsEmail' => true
    ];

    /**
     * User Model Consturctor
     */
    public function __construct(array $attributes = []){
        parent::__construct($attributes);
        $this->hintJsonStructure('options', json_encode($this->jsonStructure));
    }

    /**
     * Checks to see if the user owns the object passed in
     * @param  misc $relation An object the user has a relation with
     * @return bool           If the user owns the object or not
     */
    public function owns($relation) {
        return $this->id === $relation->user_id;
    }

    /**
     * User can see many Announcements
     */
    public function announcements(){
        return $this->belongsToMany(Annoucement::class);
    }

    /**
     * User creates many Threads
     */
    public function threads(){
        return $this->hasMany(Thread::class);
    }

    /**
     * User creates many Posts
     */
    public function posts(){
        return $this->hasMany(Post::class);
    }

    /**
     * User creates many Polls through Threads
     */
    public function polls(){
        return $this->hasManyThrough(Poll::class, Thread::class);
    }

    /**
     * User creates many Tags
     */
    public function tags(){
        return $this->hasMany(Tag::class);
    }

    /**
     * User has many Bans
     */
    public function bans(){
        return $this->morphToMany(Ban::class, 'bannable');
    }

    /**
     * Many Users have many Badges
     */
    public function badges(){
        return $this->belongsToMany(Badges::class);
    }

    /**
     * A User requests Many Users to be friends
     */
    public function friendRequests(){
        return $this->belongsToMany(self::class, 'friends', 'from_id', 'to_id');
    }

    /**
     * Returns list of confirmed friends
     *
     * @return Collection
     */
    public function getFriendsAttribute(){
        return collect(DB::table('friends as A')
            ->select('A.to_id')
            ->join('friends AS B', function($query) {
                $query->on('A.id', '<>', 'B.id')
                    ->on('A.from_id', '=', 'B.to_id')
                    ->on('B.from_id', '=', 'A.to_id');
            })->where('A.from_id', $this->id)->get())
            ->transform(function($item){
                return self::find($item);
            });
    }

    // /**
    //  * Inserts one direction friendship into Friends table
    //  *
    //  * @param \App\User
    //  * @return bool
    //  */
    // public function addFriend(User $to){
    //     return DB::table('friends')->insert(['from_id' => $this->id, 'to_id' => $to->id, "created_at" =>  \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()]);
    // }

    /**
     * Add Points using PointType
     */
    public function addPoints(PointType $points){
        $this->points += $points;
        return $this->save();
    }

    /**
     * Minus Points using PointType
     */
    public function minusPoints(PointType $points){
        return $this->addPoints(-$points);
    }

    /**
     * Returns the list of recorded Ips
     * @return Collection
     */
    public function ips(){
        return $this->belongsToMany(Ip::class)->withTimestamps();
    }

    /**
     * The percentile the User is
     *
     * @return float
     */
    public function getPercentileAttribute(){
        return (User::where('points', '<', $this->points)->count() / User::where('points', '>', '0')->count()) * 100;
    }

    public function getAvatarAttribute(){
        return $this->avatarPath . $this->avatar ?? $this->defaultAvatar;
    }
}
