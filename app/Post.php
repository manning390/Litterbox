<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use SoftDeletes{
        restore as baseRestore;
    };

    protected $dates = ['deleted_at'];

    public function user(){
        $this->belongsTo(User::class);
    }

    public function thread(){
        $this->belongsTo(Thread::class);
    }

    public function parent(){
        $this->belongsTo(Post::class, 'parent_id');
    }

    public function children(){
        $this->hasMany(Post::class, 'parent_id');
    }

    public function delete(){
        $this->update(['deleted_by', Auth::user()->id]);
        return parent::delete();
    }

    public function restore(){
        $this->update(['deleted_by', NULL]);
        return $this->baseRestore();
    }

}
