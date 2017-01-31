<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{

    protected $fillable = [
        'name', 'body'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function dismiss(User $user){
        return $this->detach($user);
    }

    public function announce(){
        return $this->users()->attach($this);
    }

    public function getHeaderAttribute(){
        return realTitleCase($this->name);
    }
}