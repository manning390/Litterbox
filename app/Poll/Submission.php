<?php

namespace App\Poll;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model {

    protected $table = 'poll_submissions';

    public function poll(){
        return $this->belongsTo(Poll::class);
    }

    public function answer(){
        return $this->belongsTo(Answer::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}