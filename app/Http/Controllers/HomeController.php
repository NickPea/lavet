<?php

namespace App\Http\Controllers;

use App\Event;
use App\Listing;
use App\Profile;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class HomeController extends Controller
{

    public function retrieveTemplate()
    {
        $data = $this->getMostRecentActivity();

        return view('home.template', ['data' => $data]);
    }


    //HELPER FUNCTIONS
    protected function getMostRecentActivity()
    {
       return Event::orderBy('updated_at', 'desc')->take(3)->get();

    }

}
