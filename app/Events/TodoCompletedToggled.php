<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TodoCompletedToggled implements ShouldBroadcast
{
    use Dispatchable, SerializesModels, InteractsWithSockets;

    public $userID;
    public $todoID;
    public $completed;

    public function __construct($userId, $todoId, $newCompletedStatus)
    {
        $this->userID = $userId;
        $this->todoID = $todoId;
        $this->completed = $newCompletedStatus;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('user.'.$this->userID);
    }

    public function broadcastAs(): string
    {
        return 'TodoCompleted';
    }
}
