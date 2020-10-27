<?php

namespace Tests\Feature;

use App\Message;
use App\MessageActivity;
use App\Traits\ModelHelper;
use App\Traits\ModelTestingHelper;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DatabaseQueryTest extends TestCase
{
    use RefreshDatabase;
    use ModelTestingHelper;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->withoutExceptionHandling();
    }

    /**--------------------------------------------------Messaging----------------------------------------------------- */

    /** @test */
    public function messaging___user_sends_a_message_to_a_user() //even to themself
    {
        //given 2 users

        $userOne = User::anyOf();
        $userTwo = User::all()->except($userOne->id)->random();

        //when message sent to other user
        $message_activity = $userOne->message()->create(['body' => 'hey dude'])
            ->message_activity()->create(['recipient_id' => $userTwo->id]);

        //then new message and message_activity created
        $this->assertDatabaseHas('message_activities', $message_activity->toArray());
        $this->assertDatabaseHas('messages', $message_activity->message->toArray());
        /** unknown error when swapped with above */
    }

    /** @test */
    public function messaging___user_send_to_many_users()
    {
        /** 
         * easy, just createMany MessageActivity 
         * but leaving for a later feature if necessary
         */
        $this->markTestIncomplete();
    }

    /** @test */
    public function messaging___user_replies_to_a_message() //even thier own message
    {
        //given a user has ANY message->id
        $userOne = User::anyOf();
        $userTwo = User::all()->except($userOne->id)->random();
        //when create a new message with parent_id = recieved message_id, and create and message_activity 

        $reply_message_activity =
            $userTwo->message()->create([
                'body' => 'whats up man',
                //any  parent(message)_id, but in this case its a recieved message, however it could be thier own message aswell
                'parent_id' => $userTwo->message_activity->random()->message->id
            ])
            ->message_activity()->create([
                'recipient_id' => $userOne->id
            ]);

        //then database has new created entries with parent_id updated
        $this->assertDatabaseHas('message_activities', $reply_message_activity->toArray());
        $this->assertDatabaseHas('messages', $reply_message_activity->message->toArray());
    }

    /** @test */
    public function messaging___user_replies_to_many_users()
    {
        $this->markTestIncomplete();
    }


    //get a users conversations (recieved & sent) sort by updated_at)
    //(ensure message touches message_activity timestamps)
    /** @test */
    public function messaging___get_all_a_users_conversations_and_sort()
    {
        $user = User::anyOf();

        $results = Message::select('*')
            ->where('author_id', $user->id)
            ->where('parent_id', null)
            ->union(
                Message::select('messages.*')
                    ->where('message_activities.recipient_id', $user->id)
                    ->join('message_activities', 'messages.id', '=', 'message_activities.message_id')
                    ->where('messages.parent_id', null)
            )
            ->orderBy('updated_at', 'desc')
            ->get();
        //then assert the message have been either sent or recieved by the user
        foreach ($results as $message) {
            $this->assertTrue(
                $message->author_id === $user->id || $message->message_activity->contains('recipient_id', $user->id)
            );
        }
    }

    //get a single conversation's messages (and mark read_at field) 
    /** @test */
    public function messaging___get_all_a_conversations_messages_and_paginate()
    {
        //given has a header message from a random user
        $user = User::anyOf();
        $messageId = Message::where('parent_id', null)->get()->random()->id;

        //when getting conversation, return all latest messages and paginate
        $numPerPage = 2;
        $pageNum = 2;

        $messages =
            Message::select('*')
            ->where('parent_id',  $messageId)
            ->orderBy('updated_at')
            ->take($numPerPage * $pageNum)
            /** 
                 * this way it keeps loading in more data (like an array_push) 
                 * when scrolling back which triggers higher pagination via http or javascript fetch calls
                */
            ->get();

        //mark all the users recieved messages (message_activities) read_at attribute to now if null
        $messageActivities = 
            MessageActivity::select('*')
                ->where('recipient_id', /** some user */ $user->id)
                ->whereIn('message_id', $messages->pluck('id'))
                ->where('read_at', null)
                ->update(['read_at' => now()]);

        // dd($user->id, $messages->flatMap->message_activity->toArray());


        $this->assertCount($numPerPage * $pageNum, $messages);
        $this->assertTrue($messages->flatMap->message_activity->where('recipient_id', $user->id)->each->read_at !== null);
    }

    /** Others to consider
     * - Deleting...though no real need of this
     * - remove/stop (soft-delete) a conversation
     * - see all conversations soft-deleted (include the deleted-by attribute)
     * - restore a conversation by user who deleted
     */

    /**------------------------------------------------Profile------------------------------------------------------- */

    //create a profile (with position, fields, location, credentials, experiences, skills)







    /**------------------------------------------------References------------------------------------------------------- */
}
