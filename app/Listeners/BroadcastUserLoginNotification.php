<?php

namespace App\Listeners;

// Añadimos l evento que ya creamos
use App\Events\UserSessionChanged;
// Añadimos el login
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BroadcastUserLoginNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    // Modificamos aqui: Login $event
    public function handle(Login $event)
    {
        //
        broadcast(new UserSessionChanged("{$event->user->name} is online", "success") );
    }
}
