<?php

namespace App\Poll;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model {

    protected $table = 'poll_answers';

    public function poll(){
        return $this->belongsto(Poll::class);
    }

    public function submissions(){
        return $this->hasMany(Submission::class);
    }

}