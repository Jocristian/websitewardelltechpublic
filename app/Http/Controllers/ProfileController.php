<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Service;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'about_me' => 'nullable|string|max:5000',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->about_me = $request->about_me;
        $user->is_online = $request->is_online;

        // handle photo
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::delete($user->profile_photo);
            }
            $user->profile_photo = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

        public function show($id)
        {
            $user = User::findOrFail($id);
            $services = Service::where('user_id', $id)->get();

            // dd($user, $services);

            return view('pages.my-profile', compact('user', 'services'));
        }

        
}
