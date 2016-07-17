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
     * The default structure of the options json.
     *
     * @var array
     */
    protected $jsonStructure = [
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
     * The percentile the User is
     *
     * @return float
     */
    public function getPercentileAttribute(){
        return (User::where('points', '<', $this->points)->count() / User::where('points', '>', '0')->count()) * 100;
    }
}
