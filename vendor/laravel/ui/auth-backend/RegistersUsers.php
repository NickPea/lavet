<?php

namespace Illuminate\Foundation\Auth;

use App\Image;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $user->profile()->create([
            'work_status' => $request->work_status,
            'about' => $request->about,
        ]);

        $this->setNewUserProfileImage($request, $user);

        $user->push();
    }

    public function setNewUserProfileImage(Request $request, User $user)
    {
        if ($request->hasFile('file')) {

            $file = $request->file;
            $path = Storage::putFile($user->email, $file, 'public');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $mimeType = $file->getClientMimeType();
            $size = Storage::size($path);

            $image = Image::create([
                'path' => $path,
                'original_name' => $originalName,
                'extension' => $extension,
                'mime_type' => $mimeType,
                'size' => $size,
            ]);

            $user->profile->image()->sync($image);
        } //endif
    }//endsetNewUserProfileImage
}
