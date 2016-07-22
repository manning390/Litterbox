<?php

namespace App\Listeners;

use App\Ip;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginListener
{
    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $event->user->ips()->attach(Ip::firstOrCreate(['ip' => request()->ip()]));
        $event->user->update(['login_at' => Carbon::now()]);
    }
}
