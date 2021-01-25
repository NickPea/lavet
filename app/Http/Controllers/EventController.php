<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    /** TEMPLATE */
    public function getTemplate(Event $event)
    {
        return view('event.template', ['event' => $event]);
    }


    /** GET COMMENTS */
    public function getEventComments(Event $event)
    {
        $comments = $event->comment()->where('parent_id', null)->get();

        $formattedComments = $comments->map(function ($comment) {
            return [
                'id' => $comment->id,
                'user_profile_path' => $comment->user->profile->path(),
                'user_profile_image_path' => $comment->user->profile->image->first()->path,
                'user_name' => $comment->user->name,
                'body' => $comment->body,
                'created_at' => $comment->created_at->diffForHumans(),
                'reply_comments' => $comment->comment_child->map(function ($replyComment) {
                    return [
                        'user_profile_path' => $replyComment->user->profile->path(),
                        'user_profile_image_path' => $replyComment->user->profile->image->first()->path,
                        'user_name' => $replyComment->user->name,
                        'body' => $replyComment->body,
                        'created_at' => $replyComment->created_at->diffForHumans(),
                    ];
                }) //inner map
            ];
        }); //outter map        

        return response($formattedComments->toArray(), 200);
    } //


    public function getEventAttendingCount(Event $event)
    {
        $rsvpCount = $event->rsvp->count();

        return response($rsvpCount, 200);
    }


    public function getEventSomeAttending(Event $event, Request $request)
    {
        $someAttending = $event->rsvp->map->user->take(3)->shuffle();

        $someAttendingFormatted = $someAttending->map(function ($user)
        {
            return [
                'name' => $user->name,
                'image' => $user->profile->image->first()->path,
                'profile' => $user->profile->path(),
            ];
        });
        
        return response($someAttendingFormatted, 200);
    }



    /** GET ALL ATTENDEES */
    public function getEventAttendingAllAttendess(Event $event, Request $request)
    {

        $attendees = $event->rsvp->map->user->map(function ($user) {
            return [
                'name' => $user->name,
                'image' => $user->profile->image->first()->path,
                'profile' => $user->profile->path(),
            ];
        });

        return response($attendees, 200);
    }


    /** NEW COMMENT */
    public function newEventComment(Event $event, Request $request)
    {
        if (Auth::guest()) {
            return response('Forbidden', 403);
        }

        $createdComment = $event->comment()->create([
            'body' => $request->new_comment,
            'user_id' => $request->user()->id,
        ]);

        return response($createdComment, 201);
    } //


    /** NEW REPLY COMMENT */
    public function newEventReplyComment(Event $event, Request $request)
    {
        if (Auth::guest()) {
            return response('Forbidden', 403);
        }

        $createdReplyComment = $event->comment()->create([
            'parent_id' => $request->main_comment_id,
            'body' => $request->new_reply_comment,
            'user_id' => $request->user()->id,
        ]);

        return response($createdReplyComment, 201);
    } //


    /** RSVP TO EVENT */
    public function postRsvpToEvent(Event $event, Request $request)
    {

        if (Auth::guest()) {
            return response('Forbidden', 403);
        }

        $newRsvp = $event->rsvp()->updateOrCreate(
            [
                'user_id' => $request->user()->id,
            ],
            [
                'status' => $request->event_status,
            ]
        );


        return response($newRsvp, 201);
    } //










}//CONTROLLER
