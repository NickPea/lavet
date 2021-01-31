<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EventController extends Controller
{

    /** TEMPLATE */
    public function getTemplate(Event $event)
    {
        return view('event.template', ['event' => $event]);
    }

    /** GET TITLE */
    public function getEventTitle(Event $event)
    {
        $title = $event->title;

        return response(['title' => $title], 200);
    }

    /** GET HOSTED BY */
    public function getEventHostedBy(Event $event)
    {
        $hosted_by = [
            'link' => $event->user->profile->path(),
            'image' => $event->user->profile->image->first()->path,
            'name' => $event->user->name,
        ];

        return response(['hosted_by' => $hosted_by], 200);
    }

    /** GET IMAGE */
    public function getEventImage(Event $event)
    {
        $image = $event->image->first()->path;

        return response(['image' => $image], 200);
    }

    /** GET TAG */
    public function getEventTag(Event $event)
    {
        $tag = $event->tag->map->name;

        return response(['tag' => $tag], 200);
    }

    /** GET ACCESS */
    public function getEventAccess(Event $event)
    {
        $access = $event->access;

        return response(['access' => $access], 200);
    }

    /** GET TIME */
    public function getEventTime(Event $event)
    {
        $time = [
            'start' => $event->start_at->format('g:i A'),
            'end' => $event->end_at->format('g:i A'),
        ];

        return response(['time' => $time], 200);
    }

    /** GET WHEN */
    public function getEventWhen(Event $event)
    {
        $when = [
            'start' => $event->start_at->format('l jS \\of F Y'),
            'end' => $event->end_at->format('l jS \\of F Y'),
        ];

        return response(['when' => $when], 200);
    }

    /** GET LOCATION */
    public function getEventLocation(Event $event)
    {
        $location = [
            'township' => $event->location->first()->township->name,
            'city' => $event->location->first()->city->name,
            'province' => $event->location->first()->province->name,
            'country' => $event->location->first()->country->name,
            'area_code' => $event->location->first()->area_code->name,
        ];

        return response(['location' => $location], 200);
    }

    /** GET ABOUT */
    public function getEventAbout(Event $event)
    {
        $about = $event->about;

        return response(['about' => $about], 200);
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

        $someAttendingFormatted = $someAttending->map(function ($user) {
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


    /** POST IMAGE */
    public function postEventImage(Event $event, Request $request)
    {
        //authenticate
        if (Auth::guest()) {
            return response('forbidden', 403);
        }

        //get user
        $reqUser = $request->user();

        //get user folder path
        $userFilesPath = Hash::make($reqUser->email);

        //store image under user and get path
        $newImagePath = $request->file('event_image')->store($userFilesPath);

        //convert to url
        $newImagePathUrl = secure_url($newImagePath);

        //create db image entry with path 
        $newDbImage = $reqUser->image()->create([
            'path' => $newImagePathUrl,
        ]);
        
        //attach/sync new db image entry to event
        $event->image()->sync($newDbImage->id);

        //get new event db image path
        $newDbImagePath = $event->image->first()->path;

        //return new db image path
        return response(['image' => $newDbImagePath], 201);
    }


    /** POST TITLE */
    public function postEventTitle(Event $event, Request $request) {

        $event->title = $request->event_title;

        $event->save();

        $event->refresh();

        return response(['title' => $event->title], 201);
    }








}//CONTROLLER
