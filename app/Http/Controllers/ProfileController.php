<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Display user profile with bookmarks and history
    public function index()
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        $bookmarks = $user->bookmarks()->with('comic')->latest()->get();
        $histories = $user->histories()->with('comic')->latest()->get();
        $comments = $user->comments()->latest()->get();

        return view('profile.index', compact('user', 'bookmarks', 'histories', 'comments'));
    }

    // Update user profile (name, profile_image, profile_banner)
    public function update(Request $request)
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
            'profile_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ]);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $validated['profile_image'] = $request->file('profile_image')->store('profiles/images', 'public');
        }

        // Handle profile banner upload
        if ($request->hasFile('profile_banner')) {
            // Delete old banner if exists
            if ($user->profile_banner) {
                Storage::disk('public')->delete($user->profile_banner);
            }
            $validated['profile_banner'] = $request->file('profile_banner')->store('profiles/banners', 'public');
        }

        $user->update($validated);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    // Delete user account and all associated data
    public function delete(Request $request)
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        // Delete profile files
        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }
        if ($user->profile_banner) {
            Storage::disk('public')->delete($user->profile_banner);
        }

        // Delete related data
        $user->bookmarks()->delete();
        $user->histories()->delete();
        $user->comments()->delete();

        // Delete the user
        $user->delete();

        // Logout
        Auth::logout();

        return redirect('/')->with('success', 'Account deleted successfully.');
    }
}
