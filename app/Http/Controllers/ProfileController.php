<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show the profile of a user.
     */
    public function showProfile($user_id)
    {
        // Fetch the user's profile
        $user = User::findOrFail($user_id);
        $posts = $user->posts()->latest()->paginate(10);

        return view('profile.show', compact('user','posts'));
    }

    /**
     * Edit the profile of the authenticated user.
     */
    public function editProfile($user_id)
    {
        // Ensure the logged-in user can only edit their own profile
        if (Auth::id() !== (int) $user_id) {
            return redirect()->route('profile.show', $user_id)->with('error', 'You can only edit your own profile.');
        }

        $user = User::findOrFail($user_id);

        return view('profile.edit', compact('user'));
    }

    /**
     * Update the profile of the authenticated user.
     */
    public function updateProfile(Request $request, $user_id)
    {
        // Ensure the logged-in user can only update their own profile
        if (Auth::id() !== (int) $user_id) {
            return redirect()->route('profile.show', $user_id)->with('error', 'You can only update your own profile.');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'profile_picture' => 'nullable|image|max:2048', // Max size 2MB
        ]);

        $user = User::findOrFail($user_id);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $filePath = $request->file('profile_picture')->store('images/profile_picture', 'public');
            $data['profile_picture'] = $filePath;
        }

        $user->update($data);

        return redirect()->route('profile.show', $user_id)->with('success', 'Profile updated successfully.');
    }
}
