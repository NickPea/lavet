<?php

namespace App\Http\Controllers;

use App\AreaCode;
use App\City;
use App\Country;
use App\Credential;
use App\Field;
use App\Image;
use App\Location;
use App\Position;
use App\Profile;
use App\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
    public function updateProfileCredential(Request $request, Profile $profile)  
    {
        $profile->credential->where('id', $request->id)->first()->update([
            'name' => $request->name,
            'institution' => $request->institution,
            'end_year' => $request->end_year,
        ]);

        return response('' , 204);
    }


    // STORE ------------------------------------------------------------------------------------------

    //credential
    public function storeProfileCredential(Request $request, Profile $profile)  
    {
        $credential = Credential::make($request->input());

        $profile->credential()->save($credential);

        return response('' , 201);
    }

    //file image
    public function storeProfileFileImage(Request $request, Profile $profile)
    {
        $path = $request->file('new_image')->store(Hash::make($profile->user->email));

        $newImage = Image::create([
                'path' => url('storage/'.$path),
                'user_id' => $profile->user->id
            ]);

        return response($newImage, 201);
    }

    
    // cammera image (recieves an "image/png" dataURL)
    public function storeProfileCameraImage(Request $request, Profile $profile)
    {
        ///cleanse, base64 decode, store and return path
        $path = Hash::make($profile->user->email).'/'.Str::random(30).'.png';
        Storage::put($path, file_get_contents($request->camera_image));
        
        $newImage = Image::create([
                'path' => url($path),
                'user_id' => $profile->user->id
            ]);

        return response($newImage, 201);
    }

    //locatoin
    public function storeProfileLocation(Request $request, Profile $profile)
    {
        //cleanse(capitalize)

        //validate
        $validation = Validator::make($request->all(), [
            'country' => ['required'],
        ]);
        
        if ($validation->fails()) {
            return response($validation->invalid() , 422);
        }

        $location = Location::firstOrCreate([
        'city_id' => City::firstOrCreate(['name' => $request->city])->id,
        'province_id' => Province::firstOrCreate(['name' => $request->province])->id,
        'country_id' => Country::firstOrCreate(['name' => $request->country])->id,
        'area_code_id' => AreaCode::firstOrCreate(['name' => $request->area_code])->id,
        ]);

        $profile->location()->sync($location);
        
        return response($profile->location->first(), 201);
    }

    // reference
    public function storeProfileReference(Request $request, Profile $profile)
    {
        if (Auth::guest()) {
            return response('Please login first', 403);
        }

        $newReference = $profile->reference()->create(
            array_merge($request->input(), ['user_id' => $request->user()->id])
        );
        return response($newReference, 201);
    }

    // experience
    public function storeProfileExperience(Request $request, Profile $profile)
    {
        $validated = Validator::make($request->all(), [
            'organisation' => ['required'],
            'work_role' => ['required'],
            'start_at' => [],
            'end_at' => [],
        ]);
        
        if ($validated->fails()) {
            return response($validated->invalid() , 422);
        } 

        $newExperience = $profile->experience()->create($request->all());
        
        return response($newExperience, 201);
    
    }
    



    // DESTROY ------------------------------------------------------------------------------------------

    public function destroyProfileCredential(Request $request, Profile $profile)  
    {
        $profile->credential->where('id', $request->id)->first()->delete();

        return response('' , 204);
    }








    // // PATCH
    // public function update(Request $request, Profile $profile)
    // {
    //     $profile->update($request->input());
    //     return response($profile->getChanges());
    // }




}
