<?php

namespace App\Http\Controllers;

use App\Event;
use App\Listing;
use App\Profile;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('welcome', ['data' => [
            $profiles = Profile::all(),
            $listings = Listing::all(),
            $events = Event::all(),
        ]]);
    }
}
