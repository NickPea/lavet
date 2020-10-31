<?php

namespace Tests\Feature;

use App\Event;
use App\Listing;
use App\Profile;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CoreTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->seed();
    }

    // Main Application Testing // ----------------------------------------------------------------------------------------

    //a guest or user views the welcome page
    /** @test */
    public function view_the_welcome_page()
    {
        //given we have data
        $profiles = Profile::all();
        $listings = Listing::all();
        $events = Event::all();

        //when request welcome page
        $response = $this->get('');

        //then check data present
        $response->assertViewIs('welcome')->assertViewHasAll([
            'data' => [$profiles, $listings, $events]
        ]);
    }

    //user registers or logs in and is redirected to the main search page 

    //user clicks on search object and retrieves...

    /** @test */
    public function view_a_profile()
    {
        //given a profile to view
        $profile = Profile::anyOf();
        //when a profile is requested
        $response = $this->get("profile/{$profile->id}");
        //then check
        $response->assertViewIs('profile.view')->assertViewHasAll(['profile' => $profile]);
    }
    /** @test */
    public function view_a_listing()
    {
        //given a listing to view
        $listing = Listing::anyOf();
        //when a listing is requested
        $response = $this->get("listing/{$listing->id}");
        //then check
        $response->assertViewIs('listing.view')->assertViewHasAll(['listing' => $listing]);
    }
    /** @test */
    public function view_an_event()
    {
        //given an event to view
        $event = Event::anyOf();
        //when a event is requested
        $response = $this->get("event/{$event->id}");
        //then check
        $response->assertViewIs('event.view')->assertViewHasAll(['event' => $event]);
    }
}
