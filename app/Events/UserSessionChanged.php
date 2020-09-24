<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

// Añadir: implements ShouldBroadcast
class UserSessionChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // ACa inicializamos todo lo q deseamos enviar
    public $message;
    public $type;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $type)
    {
        //
        $this->message = $message;
        $this->type = $type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    // Modificar 
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
        // \Log::debug("{$this->message}");
        // \Log::debug("{$this->type}");
        return new Channel('notifications');
    }
}
