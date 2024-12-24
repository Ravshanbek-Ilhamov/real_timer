<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SwitchTheStatus implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $messages;
    public function __construct($messages)
    {
        $this->messages = $messages;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('switch-status'),
        ];
    }

    public function broadcastWith()
    {
        return [
            'messages' => $this->messages->map(function ($message) {
                return [
                    'id' => $message->id,
                    'image_path' => $message->image_path ? asset('storage/' . $message->image_path) : asset('default-avatar.png'),
                    'title' => $message->title ?? 'User',
                    'message' => $message->message ?? '',
                    'created_at' => $message->created_at->format('Y-m-d H:i:s'),
                ];
            }),
        ];
    }

}
