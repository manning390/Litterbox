<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{

    protected $fillable = [
        'name', 'label'
    ];

    use SoftDeletes;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function threads(){
        return $this->belongsToMany(Thread::class);
    }

    public static function firstOrCreateMany($tags){
        if(!is_array($tags)) $tags = explode(',', $tags);

        return collect($tags)->map(function($item, $key){
            $item = trim($item);
            return self::firstOrNew('name'=> snake_case(strtolower($item)), 'label' => $item);
        });
    }
}
