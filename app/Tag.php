<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{

    use SoftDeletes;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function threads(){
        return $this->belongsToMany(Thread::class);
    }

    public function isDeleted(){
        return $this->deleted_at != NULL;
    }
}
