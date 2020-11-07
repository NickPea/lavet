<?php

namespace Tests\Feature;

use App\Event;
use App\Listing;
use App\Profile;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
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
        //when request welcome page
        $response = $this->get("/");

        //then check data present
        $response->assertViewIs('welcome');
    }

    /** @test */
    public function get_search_results_partial()
    {
        //when requeting with search query
        $response = $this->get('/search', [
            'what' => '',
            'where' => '',
            'profile_check' => 'true',
            'listing_check' => 'true',
            'event_check' => 'true',
        ]);
        //then assert
        $response->assertViewIs('search._search-results');

        //NB: very difficult to test result of search controller helper function 'retrieve data'

    }

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

    //a user can login and sign up
    /** @test */
    public function login_or_register_from_front_page_or_navbar()
    {
        //given a guest
        assert:$this->assertTrue(Auth::guest());
        //when visitng front page
        $response = $this->get('/');
        //assert a ui card exists and able to post to login controller from here
        $response->assertSeeText('Log in');
    }
    
}

