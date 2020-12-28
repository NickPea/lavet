<?php

namespace App\Http\Controllers;

use App\Message;
use App\MessageActivity;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function sendAndRefresh(Profile $profile, Request $request)
    {
        $newMessage = Message::create([
            'author_id' => Auth::user()->id,
            'body' => $request->chatMessage
        ]);

        MessageActivity::create([
            'recipient_id' => $profile->user->id,
            'message_id' => $newMessage->id
        ]);

        
        //return and array of chat message objects // {user: ***, message: ***}
        return response([], 201);
    }
}
