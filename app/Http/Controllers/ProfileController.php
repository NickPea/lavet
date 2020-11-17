<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request, Profile $profile)
    {
        return view('profileJs.template');
        // switch ($request->query('section')) {

        //     case 'about':
        //         return view('profile._about', ['profile' => $profile]);
        //         break;
        //     case 'experience':
        //         return view('profile._experience', ['profile' => $profile]);
        //         break;
        //     case 'reference':
        //         return view('profile._reference', ['profile' => $profile]);
        //         break;
        //     case 'credential':
        //         return view('profile._credential', ['profile' => $profile]);
        //         break;
        //     default:
        //         return view('profile.template', ['profile' => $profile]);
        //         break;
        // }
    }

    public function update(Request $request, Profile $profile)
    {

        $profile->update($request->input());
        return response($profile->getChanges());
    }
}
