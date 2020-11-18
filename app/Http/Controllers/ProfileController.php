<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request, Profile $profile)
    {
        switch ($request->query('section')) {
            case 'location':
                return response([
                    'city' => $profile->location->first()->city->name,
                    'province' => $profile->location->first()->province->name,
                    'country' => $profile->location->first()->country->name,
                    'area_code' => $profile->location->first()->area_code->name,
                ], 200);
                break;
            case 'about':
                return view('profile.partials._about', ['profile' => $profile]);
                break;
            case 'experience':
                return view('profile.partials._experience', ['profile' => $profile]);
                break;
            case 'reference':
                return view('profile.partials._reference', ['profile' => $profile]);
                break;
            case 'credential':
                return view('profile.partials._credential', ['profile' => $profile]);
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
