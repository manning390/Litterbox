<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * Checks to see if the user owns the object passed in
     * @param  misc $relation An object the user has a relation with
     * @return bool           If the user owns the object or not
     */
    public function owns($relation) {
        return $this->id === $relation->user_id;
    }

    public function threads(){
        return $this->hasMany(Thread::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function polls(){
        return $this->hasManyThrough(Poll::class, Thread::class);
    }

    public function tags(){
        return $this->hasMany(Tag::class);
    }
}
