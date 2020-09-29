<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSend;
use App\Models\User;
use App\Events\GreetingSend;


class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showChat()
    {
        return view('chat.show');
    }


    // P7-V4 : Esta funcion enviara el mensaje a traves de pusher
    public function messageReceived(Request $request)
    {
        $rules = [
            'message' => 'required'
        ];

        $request->validate($rules);

        // TODO: Por que saca como user()???
        \broadcast(new MessageSend($request->user(), $request->message ));
        
        return \response()->json('Message broadcast');
    }
    
    // P8-V1 : Esta funcion enviara un mensaje privado a un usuario especifico
    // request obtiene el usuario origen 
    // user tiene el usuario destino
    public function greetReceived(Request $request, User $user)
    {
        // Destino, origen
        \broadcast(new GreetingSend($user , "{$request->user()->name} greeted you!"));

        // origen, destino
        \broadcast(new GreetingSend($request->user() , "You greeted {$user->name}"));
        
        return 'Message greeting : '.$user->name . ' from '. $request->user()->name;
    }
}
