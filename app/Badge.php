<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{

    protected $fillable = [
        'name', 'label', 'path'
    ];

    public static $badgesDir = 'badges/';

    /**
     * Many Badges have many Users
     */
    public function users(){
        $this->belongsToMany(User::class);
    }

    public function getPathAttribute(){
        return self::$badgesDir . $this->path;
    }
}
