<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SideChatController extends Controller
{

    public function refreshConversations(Request $request)
    {
        if (Auth::guest()) {
            return response('Forbidden', 403);
        }

        $requestUserId = $request->user()->id;

        // get all message headers sent to or from the request user
        $headers = Message::join('message_activities', 'messages.id', 'message_activities.message_id')
            ->where('parent_id', null)
            ->where(function ($query) use ($requestUserId) {
                $query
                    ->where('author_id', $requestUserId)
                    ->orWhere('recipient_id', $requestUserId);
            })

            ->get();
        
            //TODO: TURN HEADERS INTO ELOQUENT MODELS AS NOT ABLE TO READ RELATIONSHIP METHODS BELOW////////

        //format headers into a list of conversations
        $conversations = $headers->map(function ($headerMessage) use ($requestUserId) {

            //if the request user initiated the conversation, get the first message recipient details
            if ($headerMessage->author_id == $requestUserId) { 

                return [
                    'name' => $headerMessage->message_activity->first()->user->name,
                    'photo' => $headerMessage->message_activity->first()->user->profile->image->first()->path,
                ];

            }//if

            //otherwise if someone else initiated the conversation, the the message author details
            if ($headerMessage->author_id != $requestUserId) { 

                return [
                    'name' => $headerMessage->user->name,
                    'photo' => $headerMessage->user->profile->image->first()->path,
                ];

            }//if
            
        }); //formate header


        return $conversations;
    }
}
