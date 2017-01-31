<?php

namespace App\Services;

class DonationsService {

    public function percent(){
        $percent = ($this->current() + $this->rolling()) /$this->monthly();
        if($percent > 1) $percent = 1;
        return $percent * 100;
    }

    public function current(){
        return 60;
    }

    public function monthly(){
        return 100;
    }

    public function rolling(){
        return 20;
    }

}