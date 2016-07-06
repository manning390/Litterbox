<?php

namespace App;

use Auth;
use Carbon\Carbon;

trait Lockable {
    public function lock(){
        return $this->update(['locked_at' => Carbon::now()]);
    }

    public function unlock(){
        return $this->update(['locked_at' => NULL]);
    }

    public function toggleLock(){
        return $this->locked ? $this->unlock() : $this->lock();
    }

    public function block(){
        return $this->update(['blocked_at' => Carbon::now(), 'blocked_by', Auth::user()->id]);
    }

    public function unblock(){
        return $this->update(['blocked_at' => NULL, 'blocked_by', NULL]);
    }

    public function toggleBlock(){
        return $this->blocked ? $this->unblock() : $this->block();
    }

    public function getLockedAttribute(){
        return $this->locked_at != NULL;
    }

    public function getBlockedAttribute(){
        return $this->blocked_at != NULL;
    }
}