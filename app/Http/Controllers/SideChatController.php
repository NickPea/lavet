<?php

namespace App\Http\Controllers;

use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class SideChatController extends Controller
{

    public function refreshTotalUnreadCount(Request $request)
    {

        $totalUnreadCount = 0;

        $requestUserId = $request->user()->id;

        //of all a users conversations
        $conversations = Message::where('parent_id', null)
            ->where(function ($query) use ($requestUserId) {
                $query
                    ->where('author_id', $requestUserId)
                    ->orWhereHas('message_activity', function ($query) use ($requestUserId) {
                        $query->where('recipient_id', $requestUserId);
                    });
            })
            ->get();

        //count all the child messages that
        // - are sent to the current user (not authored by the current user)
        // - and are unread
        $conversations->each(function ($conversation) use ($requestUserId, &$totalUnreadCount) {
            $unreadConversationMessageCount = $conversation->message_child
                ->where('author_id', '<>', $requestUserId)
                ->where('read_at', null)
                ->count();

            $totalUnreadCount += $unreadConversationMessageCount;
        });


        return response(['total_unread_count' => $totalUnreadCount], 200);
    }


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
                    'is_online' => $headerMessage->message_activity->first()->user->profile->is_online,
                    'unread_count' => $headerMessage->message_child
                        ->where('author_id', '<>', $requestUserId)
                        ->where('read_at', null)
                        ->count(),
                ];
            } //if

            //otherwise if someone else initiated the conversation, the the message author details
            if ($headerMessage->author_id != $requestUserId) {

                return [
                    'message_header_id' => $headerMessage->id,
                    'name' => $headerMessage->user->name,
                    'image' => $headerMessage->user->profile->image->first()->path,
                    'is_online' => $headerMessage->message_activity->first()->user->profile->is_online,
                    'unread_count' => $headerMessage->message_child
                        ->where('author_id', '<>', $requestUserId)
                        ->where('read_at', null)
                        ->count(),

                ];
            } //if

        }); //format header

        return $conversations;
    } //




    /**
     * @param Request $request->message_header_id
     * @return Message[]
     */
    public function refreshMessenger(Request $request)
    {

        if ($request->message_header_id == null) {
            return response('Missing argument: message_header_id', 500);
        }

        //get latest messages
        $latestMessages =
            Message::select('*')
            ->with('user')
            ->where('parent_id', $request->message_header_id)
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        //collections sorting hack
        $sortedLatestMessages = $latestMessages->sortBy('created_at')->values()->all();

        return response($sortedLatestMessages, 200);
    }

    /**
     * @param Request $request->message_header_id
     * @return Message $newMessage
     */
    public function sendMessage(Request $request)
    {

        if ($request->message_header_id == null) {
            return response('Missing argument: message_header_id', 500);
        }

        //add message to database
        $newMessage = Message::create([
            'parent_id' => $request->message_header_id,
            'author_id' => $request->user()->id,
            'body' => $request->chat_message,
        ]);

        //notify reciever of new message through websocket via redis
        $recipientEmail = $request->user()->id == $newMessage->message_parent->author_id
            ? $newMessage->message_parent->message_activity->first()->user->email
            : $newMessage->message_parent->user->email;

        $recipientHash = hash(hash_algos()[5], $recipientEmail); //sha256

        $redisMessage = json_encode([
            'recipientHash' => $recipientHash,
            'action' => 'sidechat/new-message',
            'payload' => [
                'conversation_id' => $newMessage->parent_id,
            ]
        ]);

        Redis::publish('FROM-LARAVEL-TO-NODE', $redisMessage);


        //confirm message created
        return response($newMessage, 201);
    }

    /**
     * @return int Number of 'Marked as read' 
     */
    public function markConversationMessagesAsRead(Request $request)
    {

        $conversationMessageHeader = Message::find($request->message_header_id);
        $userId = $request->user()->id;

        $marked = Message::select('*')
            ->where('parent_id', $conversationMessageHeader->id)
            ->where('author_id', '!=', $userId)
            ->where('read_at', null)
            ->update(['read_at' => now()]);


        //notify reciever of new message through websocket via redis
        $recipientEmail = '';
        if ($conversationMessageHeader->author_id !== $userId) {
            $recipientEmail = $conversationMessageHeader->user->email;
        } else {
            $recipientEmail = $conversationMessageHeader->message_activity->first()->user->email;
        }

        $recipientHash = hash(hash_algos()[5], $recipientEmail); //sha256

        $redisMessage = json_encode([
            'recipientHash' => $recipientHash,
            'action' => 'sidechat/read-messages',
            'payload' => [
                'conversation_id' => $conversationMessageHeader->id,
            ],
        ]);

        Redis::publish('FROM-LARAVEL-TO-NODE', $redisMessage);

        
        return response([
            'conversation_id' => $conversationMessageHeader->id,
            'count' => $marked,
            'by_user_id' => $userId,
        ], 201);
    }
}//
