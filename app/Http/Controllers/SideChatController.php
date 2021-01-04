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
        $headers = Message::where('parent_id', null)
            ->where(function ($query) use ($requestUserId) {
                $query
                    ->where('author_id', $requestUserId)
                    ->orWhereHas('message_activity', function ($query) use ($requestUserId) {
                        $query->where('recipient_id', $requestUserId);
                    });
            })
            ->get();

        //TODO: TURN HEADERS INTO ELOQUENT MODELS AS NOT ABLE TO READ RELATIONSHIP BELOW OF MESSAGE_ACTIVITY///////////////////////////

        //format headers into a list of conversations
        $conversations = $headers->map(function ($headerMessage) use ($requestUserId) {

            //if the request user initiated the conversation, get the first message recipient details
            if ($headerMessage->author_id == $requestUserId) {

                return [
                    'message_header_id' => $headerMessage->id,
                    'name' => $headerMessage->message_activity->first()->user->name,
                    'image' => $headerMessage->message_activity->first()->user->profile->image->first()->path,
                ];
            } //if

            //otherwise if someone else initiated the conversation, the the message author details
            if ($headerMessage->author_id != $requestUserId) {

                return [
                    'message_header_id' => $headerMessage->id,
                    'name' => $headerMessage->user->name,
                    'image' => $headerMessage->user->profile->image->first()->path,
                ];
            } //if

        }); //format header

        return $conversations;
    }
}
