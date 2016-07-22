<?php

namespace App\Listeners;

use App\Events\ModerationActionEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ModerationActionListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  ModerationActionEvent  $event
     * @return void
     */
    public function handle(ModerationActionEvent $event)
    {
        $action = new Action;
        $action->name = realTitleCase(array_search($event->type, ActionType::getKeys()));
        $action->body = $event->body;
        $action->save();
        $action->associate($event->user)->associate($event->ban);
    }
}
