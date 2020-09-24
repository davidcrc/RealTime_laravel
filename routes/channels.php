<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


// P4-V4 Aca creamos un canal privado, debemos redefinirlo en resources/js/app.js
// el anterior broadcast funciona para el canal publico 
Broadcast::channel('notifications', function ($user) {
    return $user != null;
});