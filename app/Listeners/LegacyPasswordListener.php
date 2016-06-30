<?php

namespace App\Listeners;

use Log;
use Auth;
use Illuminate\Auth\Events\Failed;

class LegacyPasswordListener {

    protected $upgrades = [
        \App\Services\LegacyPasswords\PhpassBcryptUpgrade::class,
        \App\Services\LegacyPasswords\Md5Upgrade::class
    ];

    /**
     * Handle the event.
     *
     * @param  IlluminateAuthEventsFailed  $event
     * @return void
     */
    public function handle(Failed $event) {
        if($event->user){
            foreach($this->upgrades as $upgrade){

                $upgrader = app()->build($upgrade);
                if($upgrader->checkLegacyPassword($event->user, $event->credentials['password'])){

                    // Log about the update in case something goes wrong
                    Log::info("User ". $event->user->id ." upgraded legacy password");

                    // Login
                    Auth::login($event->user);

                    return false;// Stop propigation
                }
            }
        }
    }
}
