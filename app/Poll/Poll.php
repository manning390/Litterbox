<?php

namespace App\Poll;

use App\Lockable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Poll extends Model
{
    use Lockable;
    use SoftDeletes{
        restore as baseRestore;
    }

    public function thread(){
        return $this->belongsTo(Thread::class);
    }

    public function user(){
        return $this->thread()->user();
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function submissions(){
        return $this->hasMany(Submission::class);
    }

    public function results(){
        return $this->answers()->pluck('answer')->zip($this->submissions()->pluck('total'));
    }

    public function delete(){
        $this->update(['deleted_by', Auth::user()->id]);
        return parent::delete();
    }

    public function restore(){
        $this->update(['deleted_by', NULL]);
        return $this->baseRestore();
    }

    public function submit($answer_id, $user_id = null){
        if($user_id == null) $user_id = Auth::user()->id;
        if(!$this->multiple)
            $this->submissions()
                ->where('poll_id', $this->id)
                ->where('user_id', $user_id)
                ->delete();

        return $this->submissions()->create([
            'poll_id'   => $this->id,
            'answer_id' => $answer_id,
            'user_id'   => $user_id
        ]);
    }

}
