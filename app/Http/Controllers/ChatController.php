<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSend;

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
}
