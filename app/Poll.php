<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Poll extends Model
{
    use Lockable;
    use SoftDeletes{
        restore as baseRestore;
    }

    private static $answersTable = 'poll_answers';
    private static $submissionsTable 'poll_submissions';

    public function thread(){
        return $this->belongsTo(Thread::class);
    }

    public function user(){
        return $this->thread()->user();
    }

    public function answers(){
        return DB::table(self::$answersTable)->select('id', 'answer')->where('poll_id', $this->id)->get();
    }

    public function submissions(){
        return DB::table(self::$submissionsTable)->select('poll_answer_id', DB::raw('count(*) as total'))->where('poll_id', $this->id)->groupBy('poll_answer_id')->get();
    }

    public function results(){
        return $this->answers()->pluck('answer')->zip($this->submissions()->pluck('total'))->all();
    }

    public function delete(){
        $this->update(['deleted_by', Auth::user()->id]);
        return parent::delete();
    }

    public function restore(){
        $this->update(['deleted_by', NULL]);
        return $this->baseRestore();
    }

    public function submit($answer_id){
        if(!$this->multiple)
            DB::table(self::$submissionsTable)
                ->where('poll_id', $this->id)
                ->where('user_id', Auth::user()->id)
                ->delete();

        return DB::table(self::$submissionsTable)->insert([
            'poll_id'   => $this->id,
            'answer_id' => $answer_id,
            'user_id'   => Auth::user()->id
        ]);
    }

    public function setAnswersAttribute(array $answers){
        DB::table(self::$answersTable)->where('poll_id', $this->id)->delete();
        $answers = collect($answers)->transform(function($val){
            return ['poll_id', $this->id, 'answer' => $val];
        });
        return DB::table(self::$answersTable)->insert($answers);
    }

    public function getAnswersAttribute(){
        return $this->answers()->pluck('answer', 'id');
    }
}
