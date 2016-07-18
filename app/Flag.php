<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    protected $fillable = [
        'type', 'status', 'body'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
