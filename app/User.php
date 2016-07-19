<?php

namespace App;

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
     * Many Users have many Badges
     */
    public function badges(){
        $this->belongsToMany(Badges::class);
    }

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
        return DB::table(self::$ip_table)->where('user_id', $this->id)->get();
    }

    /**
     * Adds an Ip to the $ip_table
     * @param string
     * @return bool
     */
    public function addIp($ip){
        if(DB::table(self::$ip_table)->where('user_id', $this->id)->where('ip', $ip)->exists()) return true;
        return DB::table(self::$ip_table)->insert(['user_id' => $this->id, 'ip' => $ip]);
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
