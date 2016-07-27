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

    public function threads(){
        return $this->belongsToMany(Thread::class);
    }

    /**
     * Get multiple Tags by name or create them if they don't exist
     *
     * @param array|string
     * @return Collection
     */
    public static function firstOrCreateMany($tags){
        if(!is_array($tags)) $tags = explode(',', $tags);

        return collect($tags)->map(function($item, $key){
            $item = trim($item);
            return self::firstOrNew(['name'=> snake_case(strtolower($item)), 'label' => $item]);
        });
    }
}
