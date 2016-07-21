<?php

namespace App\Events;

use App\Events\Event;
use App\Enums\ActionType;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ModerationActionEvent extends Event
{
    use SerializesModels;

    public $user;
    public $type;
    public $body;
    public $ban;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, ActionType $type, string $body, Ban $ban = null)
    {
        $this->user = $user;
        $this->type = $type;
        $this->body = $body;
        $this->ban = $ban;
    }

}
