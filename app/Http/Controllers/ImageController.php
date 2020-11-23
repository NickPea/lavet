<?php

namespace App\Http\Controllers;

use App\Image;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageController extends Controller
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
    public function store(Request $request)
    {
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUserProfileImage(Request $request, Profile $profile)
    {
        $path = $request->file('new_image')->store(Hash::make($profile->user->email));

        $newImage = Image::create([
                'path' => url('storage/'.$path),
                'user_id' => $profile->user->id
            ]);

        return response($newImage, 201);
    }

    
    //recieves an "image/png" dataURL
    public function storeUserProfileCameraImage(Request $request, Profile $profile)
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
