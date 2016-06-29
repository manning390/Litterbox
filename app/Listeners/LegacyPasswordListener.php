<?php

namespace App\Listeners;

use Log;
use Illuminate\Auth\Events\Failed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LegacyPasswordListener {
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  IlluminateAuthEventsFailed  $event
     * @return void
     */
    public function handle(Failed $event) {

    }
}
