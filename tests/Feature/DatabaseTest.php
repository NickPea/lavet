<?php

namespace Tests\Feature;

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
use App\Location as AppLocation;
use App\Message;
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
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Schema;

class DatabaseTest extends TestCase
{

    /** Models
     * 
     * User (Everything branches from the guest)
     * Roles, Permissions
     * Profile, Experience, Credential, Reference,
     * Business, Listing, EmployType
     * Event, Rsvp, Comments
     * Position, Discipline/Field, Skills, Images, Location (country, area-cdde, provine, city, township)
     * Message, Message_User,...MessageGroup, UserMessageGroup, Reminders
     */

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /** @test */
    public function hasTablesWithAtrributesAndRelationships()
    /*************************************** */
    {
        //user
        $this->assertTrue(Schema::hasColumns('users', [
            'name', 'email', 'email_verified_at', 'password', 'remember_token'
        ]));
        $this->assertInstanceOf(Profile::class, User::anyOf()->profile); //has one profile
        $this->assertInstanceOf(Collection::class, User::anyOf()->business); //has many business
        $this->assertInstanceOf(Collection::class, User::anyOf()->event); //has many event
        $this->assertInstanceOf(Collection::class, User::anyOf()->rsvp); //has many rsvp (event_user)
        $this->assertInstanceOf(Collection::class, User::anyOf()->role); //has many role
        $this->assertInstanceOf(Collection::class, User::anyOf()->reference); //has many reference
        $this->assertInstanceOf(Collection::class, User::anyOf()->message); //has many message
        $this->assertInstanceOf(Collection::class, User::anyOf()->message_user); //has many message_user

        //role_user (laravel pivot table)
        $this->assertTrue(Schema::hasColumns('role_user', [
            'user_id', 'role_id' //FK
        ]));

        //role
        $this->assertTrue(Schema::hasColumns('roles', [
            'name'
        ]));
        $this->assertInstanceOf(Collection::class, Role::anyOf()->user); //has many user
        $this->assertInstanceOf(Collection::class, Role::anyOf()->permission); //has many permission

        //permission_role (laravel pivot table)
        $this->assertTrue(Schema::hasColumns('permission_role', [
            'permission_id', 'role_id' //FK
        ]));

        //permission
        $this->assertTrue(Schema::hasColumns('permissions', [
            'name'
        ]));
        $this->assertInstanceOf(Collection::class, Permission::anyOf()->role); //has many role

        //profile
        $this->assertTrue(Schema::hasColumns('profiles', [
            'is_available_now', 'work_status', 'about',
            'user_id' //FK
        ]));
        $this->assertInstanceOf(User::class, Profile::anyOf()->user); //has one user
        $this->assertInstanceOf(Collection::class, Profile::anyOf()->credential); //has many credential
        $this->assertInstanceOf(Collection::class, Profile::anyOf()->experience); //has many experience
        $this->assertInstanceOf(Collection::class, Profile::anyOf()->reference); //has many reference
        $this->assertInstanceOf(Collection::class, Profile::anyOf()->image); //has morphed to many (& one main) images
        $this->assertInstanceOf(Collection::class, Profile::anyOf()->location); //has morphed to many (& one main) location
        $this->assertInstanceOf(Collection::class, Profile::anyOf()->position); //has morphed to many position
        $this->assertInstanceOf(Collection::class, Profile::anyOf()->field); //has morphed to many field
        $this->assertInstanceOf(Collection::class, Profile::anyOf()->skill); //has morphed to many skill


        //experience
        $this->assertTrue(Schema::hasColumns('experiences', [
            'organisation', 'work_role', 'start_at', 'end_at',
            'profile_id' //FK
        ]));
        $this->assertInstanceOf(Profile::class, Experience::anyOf()->profile); //has one profile

        //credential
        $this->assertTrue(Schema::hasColumns('credentials', [
            'name', 'institution', 'end_at',
            'profile_id' //FK
        ]));
        $this->assertInstanceOf(Credential::class, Credential::anyOf()->profile); //has one profie

        //reference
        $this->assertTrue(Schema::hasColumns('references', [
            'body',
            'user_id', 'profile_id' //FK
        ]));
        $this->assertInstanceOf(Profile::class, Reference::anyOf()->profile); //has one profile
        $this->assertInstanceOf(User::class, Reference::anyOf()->user); //has one user

        //business
        $this->assertTrue(Schema::hasColumns('businesses', [
            'name', 'about',
            'user_id' //FK
        ]));
        $this->assertInstanceOf(User::class, Business::anyOf()->user); //has one user
        $this->assertInstanceOf(Collection::class, Business::anyOf()->listing); //has many listing
        $this->assertInstanceOf(Collection::class, Business::anyOf()->image); //has morphed to many (& one main) images
        $this->assertInstanceOf(Collection::class, Business::anyOf()->location); //has morphed to many (& one main) location


        //listing
        $this->assertTrue(Schema::hasColumns('listings', [
            'title', 'pay_rate', 'about',
            'business_id' //FK
        ]));
        $this->assertInstanceOf(Business::class, Listing::anyOf()->business); //has one business
        $this->assertInstanceOf(Collection::class, Listing::anyOf()->employ_type); //has many employ-type
        $this->assertInstanceOf(Collection::class, Listing::anyOf()->image); //has morphed to many (& one main) images
        $this->assertInstanceOf(Collection::class, Listing::anyOf()->location); //has morphed to many (& one main) location
        $this->assertInstanceOf(Collection::class, Listing::anyOf()->position); //has morphed to many (& one main) position
        $this->assertInstanceOf(Collection::class, Listing::anyOf()->field); //has morphed to many field
        $this->assertInstanceOf(Collection::class, Listing::anyOf()->skill); //has morphed to many skill

        //employ-type-listing (laravel pivot table)
        $this->assertTrue(Schema::hasColumns('employ_type_listing', [
            'employ_type_id', 'listing_id' //FK
        ]));

        //employ-type
        $this->assertTrue(Schema::hasColumns('employ_types', ['name']));
        $this->assertInstanceOf(Collection::class, EmployType::anyOf()->listing); //has many listings

        //event
        $this->assertTrue(Schema::hasColumns('events', [
            'title', 'about', 'start_at', 'end_at',
            'user_id' //FK
        ]));
        $this->assertInstanceOf(User::class, Event::anyOf()->user); //has one user
        $this->assertInstanceOf(Rsvp::class, Event::anyOf()->rsvp); //has many rsvp (event_user)
        $this->assertInstanceOf(Collection::class, Event::anyOf()->image); //has morphed to many (& one main) images
        $this->assertInstanceOf(Collection::class, Event::anyOf()->location); //has morphed to many (& one main) location

        //rsvp
        $this->assertTrue(Schema::hasColumns('rsvps', [
            'status',
            'user_id', 'event_id' //FK
        ]));
        $this->assertInstanceOf(User::class, Rsvp::anyOf()->user); //has one user
        $this->assertInstanceOf(Event::class, Rsvp::anyOf()->event); //has one event
        $this->assertInstanceOf(Collection::class, Rsvp::anyOf()->comment); //has many comments

        //comment
        $this->assertTrue(Schema::hasColumns('comments', [
            'body',
            'rsvp_id' //FK
        ]));
        $this->assertInstanceOf(Rsvp::class, Comment::anyOf()->rsvp); //has one rsvp
        $this->assertInstanceOf(Collection::class, Comment::anyOf()->image); //has morphed to many (& one main) images

        //message
        $this->assertTrue(Schema::hasColumns('messages', [
            'subject', 'body',
            'parent_id', 'author_id' //FK
        ]));
        $this->assertInstanceOf(User::class, Message::anyOf()->user); //has one user
        $this->assertInstanceOf(Collection::class, Message::anyOf()->message_user); //has many message-user

        //message-user
        $this->assertTrue(Schema::hasColumns('message_users', [
            'is_read',
            'message_id', 'user_id', //FK
        ]));
        $this->assertInstanceOf(Message::class, MessageUser::anyOf()->message); //has one message
        $this->assertInstanceOf(User::class, MessageUser::anyOf()->user); //has one user


        /*****************************************IMAGE******************************************* */

        //image 
        $this->assertTrue(Schema::hasColumns('images', [
            'path'
        ]));
        $this->assertInstanceOf(Collection::class, Image::anyOf()->imageable);
            //has morphed by many user OR business OR listing OR event Or comment

        //imageable (laravel many-to-many polymorph table)
        $this->assertTrue(Schema::hasColumns('imageables', [
            'is_main', 'is_shown', 'is_logo', //...
            'image_id', 'imageable_id', 'imageable_type' //FK 
        ]));

        /*****************************************END IMAGE******************************************* */

        /*****************************************LOCATION******************************************* */
        
        //country
        $this->assertTrue(Schema::hasColumns('countries', [
            'name',
        ]));
        $this->assertInstanceOf(Collection::class, Country::anyOf()->location); //has many location

        //area-code
        $this->assertTrue(Schema::hasColumns('area_codes', [
            'name',
        ]));
        $this->assertInstanceOf(Collection::class, AreaCode::anyOf()->location); //has many location

        //province
        $this->assertTrue(Schema::hasColumns('provinces', [
            'name',
        ]));
        $this->assertInstanceOf(Collection::class, Province::anyOf()->location); //has many location

        //city
        $this->assertTrue(Schema::hasColumns('cities', [
            'name',
        ]));
        $this->assertInstanceOf(Collection::class, City::anyOf()->location); //has many location

        //township
        $this->assertTrue(Schema::hasColumns('townships', [
            'name',
        ]));
        $this->assertInstanceOf(Collection::class, Township::anyOf()->location); //has many location
       
        //location
        $this->assertTrue(Schema::hasColumns('locations', [
            'township_id', 'city_id', 'province_id', 'areacode_id', 'country_id' //FK ... & PK
        ]));
        $this->assertInstanceOf(Township::class, AppLocation::anyOf()->township); //has one township
        $this->assertInstanceOf(City::class, AppLocation::anyOf()->city); //has one city
        $this->assertInstanceOf(Province::class, AppLocation::anyOf()->province); //has one province
        $this->assertInstanceOf(AreaCode::class, AppLocation::anyOf()->area_code); //has one area-code
        $this->assertInstanceOf(Country::class, AppLocation::anyOf()->country); //has one country
        $this->assertInstanceOf(Collection::class, AppLocation::anyOf()->locationable); 
            //has morphed by many profile, business, listing, event

        //locationable (many-to-many polymorph table)
        $this->assertTrue(Schema::hasColumns('locationables', [
            'description', 'is_main',//....
            'location_id', 'locationable_id', 'location_type' //FK
        ]));
        

        /*****************************************END LOCATION********************************************/
        
        /*****************************************POSITION, FIELD, SKILL********************************************/

        
        //position
        $this->assertTrue(Schema::hasColumns('positions', [
            'name'
        ]));
        $this->assertInstanceOf(Collection::class, Position::anyOf()->positionable);
            //has morphed by many profile, listing

        //positionable (laravel many-to-many polymorph table)
        $this->assertTrue(Schema::hasColumns('positionables', [
            'is_main', //...
            'position_id', 'positionable_id', 'positionable_type' //FK 
        ]));

        //field
        $this->assertTrue(Schema::hasColumns('fields', [
            'name'
        ]));
        $this->assertInstanceOf(Collection::class, Field::anyOf()->fieldable);
            //has morphed by many profile, listing

        //fieldable (laravel many-to-many polymorph table)
        $this->assertTrue(Schema::hasColumns('fieldables', [
            'is_main', //...
            'field_id', 'fieldable_id', 'fieldable_type' //FK 
        ]));

        //skill
        $this->assertTrue(Schema::hasColumns('skills', [
            'name'
        ]));
        $this->assertInstanceOf(Collection::class, Skill::anyOf()->skillable);
            //has morphed by many profile, listing

        //skillable (laravel many-to-many polymorph table)
        $this->assertTrue(Schema::hasColumns('skillables', [
            'is_main', //...
            'skill_id', 'skillable_id', 'skillable_type' //FK 
        ]));

        /*****************************************END POSITION, FIELD, SKILL********************************************/
        
        /**
         * V2 features
         * 
         * // attachments (resumes for messages, profiles)
         * // forums
         * 
         */
           
    }
}
