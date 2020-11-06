<?php

namespace Tests\Feature;

use App\AreaCode;
use App\City;
use App\Comment;
use App\Country;
use App\Credential;
use App\Event;
use App\Field;
use App\Image;
use App\Location;
use App\Message;
use App\MessageActivity;
use App\Position;
use App\Profile;
use App\Province;
use App\Reference;
use App\Skill;
use App\Township;
use App\Traits\ModelHelper;
use App\Traits\ModelTestingHelper;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Support\Str;

class QueryTest extends TestCase
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
            ->where(
                'recipient_id',
                /** some user */
                $user->id
            )
            ->whereIn('message_id', $messages->pluck('id'))
            ->where('read_at', null)
            ->update(['read_at' => now()]);

        // dd($user->id, $messages->flatMap->message_activity->toArray());


        $this->assertCount($numPerPage * $pageNum, $messages);
        $this->assertTrue($messages->flatMap->message_activity->where('recipient_id', $user->id)->each->read_at !== null);
    }

    /** Others to consider
     * - Deleting...though dont really want this
     * - remove/stop (soft-delete) a conversation
     * - see all conversations soft-deleted (include the deleted-by attribute)
     * - restore a conversation by user who deleted
     */

    /**------------------------------------------------Location------------------------------------------------------- */

    //create a location and if parents don't exist then create for each one
    //given we have some location data

    /** @test */
    public function location___create_a_location_and_update_parents()
    {
        //given we have some location data
        $request = [
            'country' => 'New Zealand',
            'city' => 'Auckland',
            'area_code' => '00244',
            'province' => null,
            'township' => null
        ];

        //some cleaning of the data should occur before creating
        foreach ($request as $key => $value) {
            $request[$key] = Str::title($value);
        }

        //find or create location parents first
        $country = Country::firstOrCreate(['name' => $request['country']]);
        $area_code = AreaCode::firstOrCreate(['name' => $request['area_code']]);
        $province = Province::firstOrCreate(['name' => $request['province']]);
        $city = City::firstOrCreate(['name' => $request['city']]);
        $township = Township::firstOrCreate(['name' => $request['township']]);

        //find or create location with parent ids
        $location = Location::firstOrCreate([
            'country_id' => $country->id,
            'area_code_id' => $area_code->id,
            'province_id' => $province->id,
            'city_id' => $city->id,
            'township_id' => $township->id,
        ]);

        //then check database
        $this->assertDatabaseHas('countries', $country->toArray());
        $this->assertDatabaseHas('area_codes', $area_code->toArray());
        $this->assertDatabaseHas('provinces', $province->toArray());
        $this->assertDatabaseHas('cities', $city->toArray());
        $this->assertDatabaseHas('townships', $township->toArray());
        $this->assertDatabaseHas('locations', $location->toArray());
    }


    /**------------------------------------------------Profile------------------------------------------------------- */

    //create a profile (with position, fields, location, credentials, experiences, skills)

    /** @test */
    public function profiles___update_or_create_a_full_profile()
    {
        //given some profile data
        $data = [
            'is_free' => false,
            'about' => 'blah blah...blah',
            'work_status' => 'I build fences',
            'position' => 'banker',
            'location' => [
                'country' => 'franCe',
                'city' => 'paris',
            ],
            'field' => ['small animal', 'equine'],
            'credential' => [
                ['name' => 'Bach of NIL', 'institution' => 'hogwards', 'end_year' => 2015],
                ['name' => 'Bach of blah', 'institution' => 'Sals cars', 'end_year' => 2015],
            ],
            'experience' => [
                ['organisation' => 'maccas', 'work_role' => 'burger-flipper', 4 - 4 - 2015, null,]
            ],
            'skill' => ['sister-punching', 'BOOGER EATING'],
            'image' => '/path/to/image'
        ];

        //get or create a profile for a user with all of the available data
        $profile = User::anyOf()->profile()->firstOrCreate([]);
        //
        if (Arr::has($data, 'is_free')) {
            $profile->is_free = $data['is_free'];
        }
        if (Arr::has($data, 'about')) {
            $profile->about = $data['about'];
        }
        if (Arr::has($data, 'work_status')) {
            $profile->work_status = $data['work_status'];
        }
        if (Arr::has($data, 'position')) {
            $profile->position()->save(Position::firstOrCreate(['name' => $data['position']]));
        }
        //credential & experience etc.
        if (Arr::has($data, 'credential')) {

            foreach ($data['credential'] as $cred) {
                $profile->credential()->save(Credential::make([
                    'name' => $cred['name'],
                    'institution' => $cred['institution'],
                    'end_year' => $cred['end_year'],
                ]));
            }
        }
        //skill & field etc.
        if (Arr::has($data, 'skill')) {
            foreach ($data['skill'] as $skill) {
                $profile->skill()->save(Skill::firstOrCreate([
                    'name' => $skill,
                ]));
            }
        }
        //image
        if (Arr::has($data, 'image')) {
            //behind the scenes: store or retrieve images from public folder
            $imageId = Image::firstOrCreate(['path' => $data['image'][0]])->id;
            $profile->image()->sync([$imageId => ['is_main' => true]]);
        }
        //location
        //firstOrCreate parents
        //firstOrCreate location
        //sync location to profile so only one location exists

        //pull some sort of history for the Events the user has attended or hosted etc!!!!!

        $profile->push();

        // $profile->refresh();
        // dd($profile->load('skill', 'field', 'experience', 'credential', 'location', 'image')->toArray());

        $this->assertDatabaseHas('profiles', $profile->toArray());
        $this->assertDatabaseHas('credentials', $profile->credential->random()->makeHidden(['pivot'])->toArray());
        $this->assertDatabaseHas('skills', $profile->skill->random()->makeHidden(['pivot'])->toArray());
        //assert database has etc.
    }



    /**------------------------------------------------References------------------------------------------------------- */


    /** @test */
    public function referencing___user_creates_or_updates_a_reference_for_a_profile()
    {
        //given a user and a profile
        $user = User::anyOf();
        $profile = Profile::all()->except($user->profile->id)->random();
        $data = ['reference' => 'great people would reccommend them'];

        //create a reference
        $reference = $user->reference()->updateOrCreate(
            ['profile_id' => $profile->id],
            ['body' => $data['reference']],
        );

        $this->assertDatabaseHas('references', $reference->toArray());
    }

    /**------------------------------------------------rsvp------------------------------------------------------- */

    /** @test */
    public function referencing___create_or_update_an_rsvp_or_get_an_rsvp_and_add_a_comment()
    {
        // //given a user and an event
        // $user = User::anyOf();
        // $event = Event::anyOf();
        // $data = [
        //     'rsvp_status' => 'attending',
        //     'comment' => 'Im coming!',
        // ];

        // //create an rsvp
        // $rsvp = $user->rsvp()->updateOrCreate(
        //     ['event_id' => $event->id],
        //     ['status' => $data['rsvp_status']]
        // );

        // //add an optional intial commment
        // if (Arr::has($data, 'comment')) {
        //     $rsvp->comment()->save(Comment::make([
        //         'body' => $data['comment'],
        //     ]));
        // }

        // //check database
        // $this->assertDatabaseHas('rsvps', $rsvp->toArray());
        // $this->assertDatabaseHas('comments', $rsvp->comment->where(['body' => $data['comment']])->toArray());
    }

    /**------------------------------------------------Search & Paginate------------------------------------------------------- */

    /** @test */
    public function search___profiles___by_isfree_username_position_field_skill_location___sort_by___and_paginate()
    {

        //V.1 SEARCH DATA
        $data = [
            //WHICH
            'type' => 'profile', // all, profile, listing, event
            //WHAT
            'what' => 'sally', //keyword search
            //WHERE:
            'country' => 'poosville',
            'area_code' => null,
            'province' => null,
            'city' => null,
            'township' => 'assburgers',
        ];

        // //V2 SEARCH DATA
        // /** dynamic filter parameters dependant on type */
        // $data2 = [
        // //all - no dynamic parameters
        // //profile
        // 'is_free' => true,
        // 'sortby' => 'recently-active', //vs most-relevant/random/nothing
        // //listing
        // 'employ_type' => 'full-time', //vs any vs casual/locum etc.
        // 'pay_rate_type' => 'annually', //vs hourly
        // 'pay_rate_min' => 50000,
        // 'pay_rate_max' => 100000,
        // 'sortby' => 'latest', //vs highest-pay vs..
        // //event
        // 'sortby' => 'start_date'
        // ];


        //** profile to test against */
        $user = User::anyOf();
        $user->profile()->save(factory(Profile::class)->make());
        $user->profile->field()->save(Field::firstOrCreate(factory(Field::class)->raw(['name' => 'sally'])));
        $user->profile->location()->save(Location::firstOrCreate(factory(Location::class)->raw([
            'township_id' => Township::firstOrCreate(['name' => 'assburgers']),
            'country_id' => Country::firstOrCreate(['name' => 'poosville']),
        ])));


        //CLEAN DATA HERE


        //RETURN VARIABLE (COLLECTION OF COLLECTIONS)
        $results = collect();


        //MAIN LOGIC (PROFILE)
        if ($data['type'] === 'profile' || $data['type'] === 'all') {

            $results->push( //push the whole collection
                Profile::select('*')
                    ->when($data['what'] !== null, function ($query) use ($data) {
                        $query->whereHas('user', function ($query) use ($data) {
                            $query->where('name', 'like', "%{$data['what']}%");
                        }) //user
                            ->orWhereHas('position', function ($query) use ($data) {
                                $query->where('name', 'like', "%{$data['what']}%");
                            }) //position
                            ->orWhereHas('field', function ($query) use ($data) {
                                $query->where('name', 'like', "%{$data['what']}%");
                            }) //field
                            ->orWhereHas('skill', function ($query) use ($data) {
                                $query->where('name', 'like', "%{$data['what']}%");
                            }); //skill
                    })
                    ->whereHas('location', function ($query) use ($data) {
                        $query->when($data['country'] !== null, function ($query) use ($data) {
                            $query->whereHas('country', function ($query) use ($data) {
                                $query->where('name', 'like', "%{$data['country']}%");
                            });
                        })
                            ->when($data['area_code'] !== null, function ($query) use ($data) {
                                $query->whereHas('area_code', function ($query) use ($data) {
                                    $query->where('name', 'like', "%{$data['area_code']}%");
                                });
                            })
                            ->when($data['province'] !== null, function ($query) use ($data) {
                                $query->whereHas('province', function ($query) use ($data) {
                                    $query->where('name', 'like', "%{$data['province']}%");
                                });
                            })
                            ->when($data['city'] !== null, function ($query) use ($data) {
                                $query->whereHas('city', function ($query) use ($data) {
                                    $query->where('name', 'like', "%{$data['city']}%");
                                });
                            })
                            ->when($data['township'] !== null, function ($query) use ($data) {
                                $query->whereHas('township', function ($query) use ($data) {
                                    $query->where('name', 'like', "%{$data['township']}%");
                                });
                            });
                    })
                    ->with([
                        'user:name,id',
                        'position:name,id',
                        'field:name,id',
                        'skill:name,id',
                        'location.country:name,id',
                        'location.area_code:name,id',
                        'location.province:name,id',
                        'location.city:name,id',
                        'location.township:name,id',
                    ])
                    ->get()
            );//end push
        }//end if

        //MAIN LOGIC (LISTING)
        //MAIN LOGIC (EVENT)

        //SORT RESULTS AND PAGINATE

        //dd($results->toArray());
    
        $this->markTestSkipped('basically complete');

    }//end test function



}
