<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewPostCreatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $unreadNotifications;

    public function __construct($unreadNotifications)
    {
        $this->unreadNotifications = $unreadNotifications;
    }

    public function broadcastOn(): Channel
    {
        return new PrivateChannel('admin-notifications');
    }
}
