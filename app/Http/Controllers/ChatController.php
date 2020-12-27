<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function send(Profile $profile, Request $request)
    {
        //return and array of chat message objects // {user: ***, message: ***}
        return response( '', 201);
    }
}
