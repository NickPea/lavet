<?php

namespace App\Http\Controllers;

use App\AreaCode;
use App\City;
use App\Country;
use App\Credential;
use App\Field;
use App\Location;
use App\Position;
use App\Profile;
use App\Province;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request, Profile $profile)
    {
        switch ($request->query('section')) {
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
    // RETRIEVE ------------------------------------------------------------------------------------------

    public function retrieveProfileImage(Request $request, Profile $profile)
    {
        return response([
            'path' => $profile->image->first()->path
        ], 200);
    }
    public function retrieveProfileName(Request $request, Profile $profile)
    {
        return response(['name' => $profile->user->name], 200);
    }
    public function retrieveProfileField(Request $request, Profile $profile)
    {
        return response(['field' => $profile->field->first()->name], 200);
    }
    public function retrieveProfilePosition(Request $request, Profile $profile)
    {
        return response(['position' => $profile->position->first()->name], 200);
    }
    public function retrieveProfileLocation(Request $request, Profile $profile)
    {
        $location = $profile->location->first();
        
        return response([
            'city' => $location->city->name,
            'province' => $location->province->name,
            'country' => $location->country->name,
            'area_code' => $location->area_code->name,
        ], 200);
    }
    public function retrieveProfileUserImages(Request $request, Profile $profile)
    {
        return response(['user_images' => $profile->user->image->sortByDesc('updated_at')->values()->map(function ($img)
        {
            return [
                'path' => $img->path,
                'id' => $img->id,
            ];
        })], 200);
    }
    public function retrieveProfileAbout(Request $request, Profile $profile)
    {
        return response(['about' => $profile->about], 200);
    }

    public function retrieveProfileCredential(Request $request, Profile $profile)
    {
        return response([
            'count' => $profile->credential->count(),
            'items' => $profile->credential->sortByDesc('end_year')->take(3)->values(),
        ], 200);
    }
    

    // UPDATE ------------------------------------------------------------------------------------------

    public function updateProfileImage(Request $request, Profile $profile)  
    {
        $profile->image()->sync($request->selected_image);
        return response($profile->image->first() , 200);
    }
    public function updateProfileName(Request $request, Profile $profile)  
    {
        $profile->user->name = $request->name;
        $profile->push();

        return response('profile name updated' , 204);
    }
    public function updateProfileField(Request $request, Profile $profile)  
    {
        $field = Field::firstOrCreate(['name' => $request->field]);
        $profile->field()->sync($field->id);

        return response('profile field updated' , 204);
    }
    public function updateProfilePosition(Request $request, Profile $profile)  
    {
        $position = Position::firstOrCreate(['name' => $request->position]);
        $profile->position()->sync($position->id);

        return response('profile field updated' , 204);
    }
    public function updateProfileLocation(Request $request, Profile $profile)  
    {
        $city = City::firstOrCreate(['name' => $request->city]);
        $province = Province::firstOrCreate(['name' => $request->province]);
        $area_code = AreaCode::firstOrCreate(['name' => $request->area_code]);
        $country = Country::firstOrCreate(['name' => $request->country]);

        $location = Location::firstOrCreate([
            'city_id' => $city->id,
            'province_id' => $province->id,
            'area_code_id' => $area_code->id,
            'country_id' => $country->id,
        ]);

        $profile->location()->sync($location->id);

        return response('profile field updated' , 204);
    }
    public function updateProfileAbout(Request $request, Profile $profile)  
    {
        $profile->about = $request->about;
        $profile->save();

        return response('' , 204);
    }



    // STORE ------------------------------------------------------------------------------------------

    public function storeProfileCredential(Request $request, Profile $profile)  
    {
        $credential = Credential::make($request->input());

        $profile->credential()->save($credential);

        return response('' , 204);
    }


    // DESTROY ------------------------------------------------------------------------------------------

    public function destroyProfileCredential(Request $request, Profile $profile)  
    {
        $profile->credential->where('id', $request->credential_id)->first()->delete();

        return response('' , 204);
    }








    // // PATCH
    // public function update(Request $request, Profile $profile)
    // {
    //     $profile->update($request->input());
    //     return response($profile->getChanges());
    // }




}
