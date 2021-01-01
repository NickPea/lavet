<?php

namespace App\Http\Controllers;

use App\Message;
use App\MessageActivity;
use App\Profile;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use SebastianBergmann\Environment\Console;

class ChatController extends Controller
{

    public function sendAndRefresh(Profile $profile, Request $request)
    {

        // //auth
        // if ($request->user == null) {
        //     return response('Please Login First', 401);
        // }

        $senderId = $request->user()->id;
        $recipientId = $profile->user->id;

        //find previous conversation parent message

        $ConversationParentMessage = Message::
            join('message_activities', 'messages.id', '=', 'message_activities.message_id')
            ->where(function ($query) use ($senderId, $recipientId) {
                $query
                    ->where('messages.author_id', $senderId)
                    ->where('message_activities.recipient_id', $recipientId);
            })
            ->orWhere(function ($query) use ($senderId, $recipientId) {
                $query
                    ->where('messages.author_id', $recipientId)
                    ->where('message_activities.recipient_id', $senderId);
            })
            ->select('messages.*')
            ->first();


        //if conversation parent message doesn't exist, create it and return it

        if ($ConversationParentMessage == null) {

            //create conversation parent message
            $newConversationParentMessage = Message::create([
                'author_id' => $senderId,
                'body' => 'CONVERSATION HEADER'
            ]);

            //and link to recipient
            $newConversationParentMessage->message_activity()->create([
                'recipient_id' => $recipientId
            ]);
            
            //reassign previous null variable
            $ConversationParentMessage = $newConversationParentMessage;
        }

        //create new message with conversation parent id and request chatMessage

        if ($request->chatMessage != null) {

            //add message to database
            Message::create([
                'parent_id' => $ConversationParentMessage->id,
                'author_id' => $senderId,
                'body' => $request->chatMessage,
            ]);

            //notify reciever of new message through websocket via redis
            $recipientHash = hash(hash_algos()[5], User::find($recipientId)->email); //sha256
            $redisMessage = json_encode([
                'recipientHash' => $recipientHash,
                'action' => 'new-message'
            ]);
            

            Redis::publish('FROM-LARAVEL-TO-NODE', $redisMessage);
        }

        //get conversation messages based on conversation parent message id

        $latestMessages = 
            Message::select('*')
            ->with('user')
            ->where('parent_id', $ConversationParentMessage->id)
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        //collections sorting hack
        $sortedLatestMessages = $latestMessages->sortBy('created_at')->values()->all();

        return response($sortedLatestMessages, 201);

    }//sendAndRefresh


    public function refresh(Profile $profile, Request $request)
    {
        
        //todo: auth

        $senderId = $request->user()->id;
        $recipientId = $profile->user->id;

        //find previous conversation parent message

        $ConversationParentMessage = Message::
            join('message_activities', 'messages.id', '=', 'message_activities.message_id')
            ->where(function ($query) use ($senderId, $recipientId) {
                $query
                    ->where('messages.author_id', $senderId)
                    ->where('message_activities.recipient_id', $recipientId);
            })
            ->orWhere(function ($query) use ($senderId, $recipientId) {
                $query
                    ->where('messages.author_id', $recipientId)
                    ->where('message_activities.recipient_id', $senderId);
            })
            ->select('messages.*')
            ->first();


        //get conversation messages based on conversation parent message id

        $latestMessages = 
            Message::select('*')
            ->with('user')
            ->where('parent_id', $ConversationParentMessage->id)
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        //collections sorting hack
        $sortedLatestMessages = $latestMessages->sortBy('created_at')->values()->all();

        return response($sortedLatestMessages, 200);


    }//refresh
}




/** ------------------------------------------------------------------------------------- **/


/**
 * Socket.io Homework tips to improve chat system
 * 
 * Broadcast a message to connected users when someone connects or disconnects.
 * Add support for nicknames.
 * Don’t send the same message to the user that sent it. Instead, append the message directly as soon as he/she presses enter.
 * Add “{user} is typing” functionality.
 * Show who’s online.
 * Add private messaging.
 * 
 * 
 */
