<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Notifica;

class NotifyEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notifica;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Notifica $notifica)
    {
        $this->notifica = $notifica;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('notifica');
    }
}
