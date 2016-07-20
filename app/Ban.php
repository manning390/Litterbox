<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ban extends Model
{
    use SoftDeletes;

    $timestamps = [
        'expires', 'deleted_at'
    ];

    public function users(){
        return $this->morphedByMany(User::class, 'bannable');
    }

    public function creators(){
        return $this->hasManyThrough(User::class, Action::class);
    }

    public function ips(){
        return $this->morphedByMany(Ip::class, 'bannable');
    }

    public function actions(){
        return $this->hasMany(Action::class);
    }
}
