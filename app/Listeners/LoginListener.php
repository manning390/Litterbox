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
        $ip = Ip::firstOrCreate(['ip' => request()->ip()]);
        if(!$event->user->ips->contains($ip))
            $event->user->ips()->attach($ip);
        $event->user->update(['login_at' => Carbon::now()]);
    }
}
