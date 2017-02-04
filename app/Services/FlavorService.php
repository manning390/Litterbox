<?php

namespace App\Services;

use DB;

class FlavorService {

    protected $table = 'flavors';

    public function flave() {
        return DB::table($this->table)->inRandomOrder()->first()->name;
    }
}