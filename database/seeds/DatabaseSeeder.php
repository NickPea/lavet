<?php

use App\AreaCode;
use App\Business;
use App\City;
use App\Comment;
use App\Country;
use App\Credential;
use App\EmployType;
use App\Event;
use App\Experience;
use App\Field;
use App\Image;
use App\Listing;
use App\Location;
use App\Message;
use App\MessageActivity;
use App\MessageUser;
use App\Permission;
use App\Position;
use App\Profile;
use App\Province;
use App\Reference;
use App\Role;
use App\Rsvp;
use App\Skill;
use App\Township;
use App\Traits\ModelHelper;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {

        //user
        factory(User::class, 5)->create();
        //role
        User::all()->each(function ($user)
        {
            $user->role()->attach(factory(Role::class)->create());
        });
        //permission
        Role::all()->each(function ($role)
        {
            $role->permission()->attach(factory(Permission::class)->create());
        });
        //profile
        User::all()->each(function ($user)
        {
            $user->profile()->save(factory(Profile::class)->make());
        });
        //experience
        Profile::all()->each(function ($profile)
        {
            $profile->experience()->save(factory(Experience::class)->make());
            
        });
        //credential
        Profile::all()->each(function ($profile)
        {
            $profile->credential()->save(factory(Credential::class)->make());
            
        });
        //reference
        User::all()->each(function ($user)
        {
            $user->reference()->save(factory(Reference::class)->make([
                'profile_id' => Profile::all()->except($user->profile->id)->random()->id
            ]));
        });
        //business
        User::all()->each(function ($user)
        {
            $user->business()->save(factory(Business::class)->make());
        });
        //listing
        Business::all()->each(function ($business)
        {
            $business->listing()->save(factory(Listing::class)->make());
        });
        //employ_type
        Listing::all()->each(function ($listing)
        {
            $listing->employ_type()->attach(factory(EmployType::class)->create());
        });
        //event
        User::all()->each(function ($user)
        {
            $user->event()->save(factory(Event::class)->make());
        });
        //rsvp
        User::all()->each(function ($user)
        {
            $user->rsvp()->save(factory(Rsvp::class)->make([
                'event_id' => Event::anyof()->id,
            ]));
        });
        //comment
        Rsvp::all()->each(function ($rsvp)
        {
            $rsvp->comment()->save(factory(Comment::class)->make());
        });
        //message
        User::all()->each(function ($user)
        {
            $user->message()->save(factory(Message::class)->make());

        });
        //message_child
        Message::all()->each(function ($message)
        {
            for ($i=0; $i < 5; $i++) { 
                $message->message_child()->save(factory(Message::class)->make([
                    'author_id' => User::anyOf()->id
                ]));    
            }
        });
        //message_activity
        Message::all()->each(function ($message)
        {
            $message->message_activity()->save(factory(MessageActivity::class)->make([
                'recipient_id' => User::anyOf()->id,
            ]));
        });
        //image
        factory(Image::class, 5)->create();
        Image::all()->each(function ($image)
        {
            Profile::anyOf()->image()->save($image);
            Business::anyOf()->image()->save($image);
            Listing::anyOf()->image()->save($image);
            Event::anyOf()->image()->save($image);
            Comment::anyOf()->image()->save($image);
        });

        //location & parents
        for ($i=0; $i < 10; $i++) { 
            Country::firstOrCreate(factory(Country::class)->raw());
            AreaCode::firstOrCreate(factory(AreaCode::class)->raw());
            Province::firstOrCreate(factory(Province::class)->raw());
            City::firstOrCreate(factory(City::class)->raw());
            Township::firstOrCreate(factory(Township::class)->raw());
        }//used instead of save() due to unique integrity constraint
        for ($i=0; $i <10 ; $i++) { 
            Location::firstOrCreate(factory(Location::class)->raw());
        }//used instead of save() due to unique integrity constraint

        User::all()->each(function ($user)
        {
            $user->profile->location()->save(Location::anyOf());
            $user->business->random()->location()->save(Location::anyOf());
            $user->business->random()->listing->random()->location()->save(Location::anyOf());
            $user->event->random()->location()->save(Location::anyOf());
        });

        //position
        User::all()->each(function ($user)
        {
            $user->profile->position()->save(factory(Position::class)->make());
            $user->business->each(function($business)
            {
                $business->listing->each(function ($listing)
                {
                    $listing->position()->save(factory(Position::class)->make());
                });
                
            });
        });
        
        //field
        for ($i=0; $i < 5; $i++) { 
            Field::firstOrCreate(factory(Field::class)->raw());
        }
        User::all()->each(function ($user)
        {
            $user->profile->field()->save(Field::anyOf());
            $user->business->each(function($business)
            {
                $business->listing->each(function ($listing)
                {
                    $listing->field()->save(Field::anyOf());
                });
                
            });
        });
        
        //skill
        User::all()->each(function ($user)
        {
            $user->profile->skill()->save(factory(Skill::class)->make());
            $user->business->each(function($business)
            {
                $business->listing->each(function ($listing)
                {
                    $listing->skill()->save(factory(Skill::class)->make());
                });
                
            });
        });


    }
}
