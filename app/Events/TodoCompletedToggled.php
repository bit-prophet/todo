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

    public $userId;
    public $todoTitle;
    public $newCompletedStatus;

    public function __construct($userId, $todoTitle, $newCompletedStatus)
    {
        $this->userId = $userId;
        $this->todoTitle = $todoTitle;
        $this->newCompletedStatus = $newCompletedStatus;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('user.'.$this->userId);
    }

    public function broadcastAs(): string
    {
        return 'TodoCompleted';
    }
}
