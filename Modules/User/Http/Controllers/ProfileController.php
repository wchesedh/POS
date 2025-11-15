<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Modules\User\Rules\MatchCurrentPassword;

class ProfileController extends Controller
{

    public function edit() {
        return view('user::profile');
    }


    public function update(Request $request) {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id()
        ]);

        auth()->user()->update([
            'name'  => $request->name,
            'email' => $request->email
        ]);

        if ($request->has('image')) {
            // Delete old avatar
            if (auth()->user()->getFirstMedia('avatars')) {
                auth()->user()->getFirstMedia('avatars')->delete();
            }

            // Add new avatar from dropzone
            $imagePath = Storage::path('temp/dropzone/' . $request->image);
            if (file_exists($imagePath)) {
                auth()->user()->addMedia($imagePath)->toMediaCollection('avatars');
                // Clean up the temp file
                Storage::delete('temp/dropzone/' . $request->image);
            }
        }

        toast('Profile Updated!', 'success');

        return back();
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'current_password'  => ['required', 'max:255', new MatchCurrentPassword()],
            'password' => 'required|min:8|max:255|confirmed'
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->password)
        ]);

        toast('Password Updated!', 'success');

        return back();
    }
}
