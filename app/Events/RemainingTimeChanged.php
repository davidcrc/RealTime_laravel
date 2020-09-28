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
class RemainingTimeChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // ACa inicializamos todo lo q deseamos enviar
    public $time;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($time)
    {
        //
        $this->time = $time;

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
        \Log::debug("{$this->time}");
        
        return new Channel('game');
    }
}
