<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index()
    {
        if (!Auth::check()) return redirect('/login');
        return $this->show(Auth::user()->username);
    }

    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        
        $videos = $user->videos()->latest()->get();
        
        $stats = [
            'following' => $user->following()->count(),
            'followers' => $user->followers()->count(),
            'likes' => $user->videos()->sum('likes_count'),
        ];

        $isOwnProfile = Auth::id() === $user->id;
        $isFollowing = false;
        
        if (Auth::check() && !$isOwnProfile) {
            $isFollowing = Auth::user()->isFollowing($user);
        }

        return Inertia::render('Profile', [
            'profileUser' => $user,
            'videos' => $videos,
            'stats' => $stats,
            'isFollowing' => $isFollowing,
            'isOwnProfile' => $isOwnProfile,
        ]);
    }

    public function edit()
    {
        return Inertia::render('Profile/Edit', [
            'auth' => [
                'user' => Auth::user(),
            ],
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'bio' => 'nullable|string|max:80',
            'avatar' => 'nullable|image|max:5120', // 5MB
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->bio = $request->bio;

        if ($request->hasFile('avatar')) {
            Log::info('[ProfileController] Avatar file received: ' . $request->file('avatar')->getClientOriginalName());

            // Delete old avatar from storage if it's a storage path
            if ($user->avatar && str_contains($user->avatar, '/storage/')) {
                Storage::delete(str_replace('/storage/', 'public/', $user->avatar));
            }

            // Store using the public disk so files are accessible via the symlink
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = '/storage/' . $path;

            Log::info('[ProfileController] Avatar stored at: ' . $user->avatar);
        }

        $user->save();

        Log::info('[ProfileController] User saved. Avatar: ' . $user->avatar);

        return redirect("/profile/@{$user->username}");
    }
}
