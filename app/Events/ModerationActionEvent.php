<?php

namespace App\Events;

use App\Ban;
use App\User;
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
    public function __construct(User $user, string $type, string $body, Ban $ban = NULL)
    {
        if(!ActionType::isValidValue($type)) throw new EnumException("Argument is not a valid value for expected Enum.");
        $this->user = $user;
        $this->type = $type;
        $this->body = $body;
        $this->ban = $ban;
    }

}
