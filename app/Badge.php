<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{

    protected $fillable = [
        'name', 'label', 'path'
    ];

    protected $badgesPath = '/img/badges/';

    /**
     * Many Badges have many Users
     */
    public function users(){
        $this->belongsToMany(User::class);
    }

    public function getPathAttribute(){
        return $this->badgesPath . $this->path;
    }
}
