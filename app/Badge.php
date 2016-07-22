<?php

namespace App;

use Storage;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{

    public static $badgeDir = 'badges/';

    protected $fillable = [
        'name', 'label', 'filename'
    ];

    /**
     * Many Badges have many Users
     */
    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function getPathAttribute(){
        return Storage::url(self::$badgeDir . $this->filename);
    }
}
