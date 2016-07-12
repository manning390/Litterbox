<?php

namespace App\Listeners;

use App\Events\ThreadViewedEvent;
use Illuminate\Session\Store;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ThreadViewedListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle the event.
     *
     * @param  ThreadViewedEvent  $event
     * @return void
     */
    public function handle(ThreadViewedEvent $event)
    {
        $thread = $event->thread;
        $thread->increment('views');

        $thread->views += 1;
    }
}
