<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileFormRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id){
        $user = User::find($id);
        return view('profile.index', compact('user'));
    }

    /**
     * show the form for the update
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(){
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Updates the user's profile
     *
     * @param ProfileFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileFormRequest $request){
        $user = Auth::user();
        if ($request->file) {
            $oldFile = $user->picture;
            $newFile = $this->addPhoto($request->file);

            $attributes = array_merge($request->except(['oldPassword', 'newPassword', 'file']), ['picture' => $newFile]);
            $user->update($attributes);
            if ($oldFile !== 'default_profile_pic.png') {
                Storage::delete($oldFile);
            }

        } else {
            $user->update($request->except(['oldPassword', 'newPassword', 'file']));
        }

        if (($oldPassword = $request->oldPassword)) {
            if (Hash::check($oldPassword, $user->getAuthPassword())) {
                $user->update(['password' => bcrypt($request->newPassword)]);
            }
        }
        return redirect()->route('profile', Auth::id())->with('success', 'Profile successfully updated!');
    }

    /**
     * Adds a photo into the img directory and returns the file name
     *
     * @param $file
     * @return string $filename
     */
    private function addPhoto($file){
        $image = $file;
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('img/'.$filename);
        Image::make($image)->resize(200, 200)->save($location);

        return $filename;
    }
}
