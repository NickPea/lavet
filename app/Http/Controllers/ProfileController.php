<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request, Profile $profile)
    {
        switch ($request->query('section')) {

            case 'about':
                return view('profile._about', ['profile' => $profile]);
                break;
            case 'experience':
                return view('profile._experience', ['profile' => $profile]);
                break;

            default:
                return view('profile.template', ['profile' => $profile]);
                break;
        }
    }

    public function update(Request $request, Profile $profile)
    {

        $profile->update($request->input());
        return response($profile->getChanges());
    }
}
