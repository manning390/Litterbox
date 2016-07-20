<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function bans(){
        return $this->morphToMany(Ban::class, 'bannable');
    }
}
