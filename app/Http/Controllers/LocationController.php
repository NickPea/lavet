<?php

namespace App\Http\Controllers;

use App\AreaCode;
use App\City;
use App\Country;
use App\Location;
use App\Profile;
use App\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Profile $profile)
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        //
    }
}
