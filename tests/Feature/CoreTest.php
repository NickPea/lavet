<?php

namespace Tests\Feature;

use App\Event;
use App\Image;
use App\Listing;
use App\Profile;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
        $response->assertViewIs('welcome.welcome');
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
        $response->assertViewIs('profile.template')->assertViewHasAll(['profile' => $profile]);
    }
    /** @test */
    public function view_a_listing()
    {
        //given a listing to view
        $listing = Listing::anyOf();
        //when a listing is requested
        $response = $this->get("listing/{$listing->id}");
        //then check
        $response->assertViewIs('listing.template')->assertViewHasAll(['listing' => $listing]);
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
        $response->assertSeeText('Log In');
    }

    /** @test */
    public function on_registration_a_profile_is_create_with_an_uploaded_profile_imag()
    {
        //setup
        
        //given guest
        $this->assertTrue(Auth::guest());

        //when registering with details + image file
        $newUserDetails = [
            'file' => UploadedFile::fake()->image('daisy.jpg'),
            'name' => 'someone',
            'email' => 'someone@somewhere.com',
            'password' => 'someonePassword',
            'password_confirmation' => 'someonePassword',
        ];

        $response = $this->post('/register', $newUserDetails);
        //then user is logged in, and has a profile with an image.
        $this->assertAuthenticated();
        $this->assertInstanceOf(Profile::class, Auth::user()->profile);
        $this->assertInstanceOf(Image::class, Auth::user()->profile->image->first());
        Auth::user()->profile->image->first();//contineu herer
        //and then redirected to a dashboard
        $response->assertRedirect('/');

    }

    /** @test */
    public function user_updates_any_of_their_profile_data()
    {
        //given a user and some updated data
        $this->actingAs($user = User::anyOf());
        $data = [
            'about' => 'some updated about text',
            'work_status' => 'looking for love'
        ];
        //when requesting a patch
        $response = $this->patch("profile/{$user->profile->id}", $data);
        //then return the patched data only
        $response->assertJson($data);
    }
        
}

// force salary range per category of employee wanted on on job making to encourgae 
// select range of salary and number of year of experience

//front
//lift search bar up and make stand out
//quick links underneath
//3 per page (events)

//job page show salary and experience sought

//event is good

//work on ads and profile