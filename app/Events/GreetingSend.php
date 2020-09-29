<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class GreetingSend implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // ACa inicializamos todo lo q deseamos enviar
    protected $user;
    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $message)
    {
        //
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    // P8-V2 : Sera un canal por cada usuario 
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
        \Log::debug("{$this->message}");
        // \Log::debug("{$this->user->name} : {$this->message}  ");
        return new PrivateChannel("chat.greet.{$this->user->id}");
    }
}
