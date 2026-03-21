<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FollowController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $following = $user ? $user->following()->get() : [];
        
        $query = User::where('id', '!=', Auth::id())
            ->whereDoesntHave('followers', function ($query) {
                $query->where('follower_id', Auth::id());
            });

        if (!$request->query('all')) {
            $query->limit(20);
        }

        $suggested = $query->get();

        return Inertia::render('Following', [
            'followingUsers' => $following,
            'suggestedUsers' => $suggested,
            'showingAll' => !!$request->query('all'),
        ]);
    }

    public function toggle(User $user)
    {
        $follower = Auth::user();

        if ($follower->id === $user->id) {
            return back()->withErrors(['message' => 'You cannot follow yourself.']);
        }

        if ($follower->isFollowing($user)) {
            $follower->following()->detach($user->id);
            $following = false;
        } else {
            $follower->following()->attach($user->id);
            $following = true;
            
            \App\Models\Notification::create([
                'user_id' => $user->id,
                'sender_id' => $follower->id,
                'type' => 'follow',
                'reference_id' => null,
            ]);
        }

        if (request()->wantsJson()) {
            return response()->json(['following' => $following]);
        }

        return back();
    }

    public function suggested()
    {
        // Get 5 users that the current user is not following
        $userId = Auth::id();
        
        $suggested = User::where('id', '!=', $userId)
            ->whereDoesntHave('followers', function ($query) use ($userId) {
                $query->where('follower_id', $userId);
            })
            ->get();

        return response()->json($suggested);
    }

    public function following()
    {
        $user = Auth::user();
        $following = $user ? $user->following()->get() : [];
        return response()->json($following);
    }

    public function friendsPage()
    {
        $user = Auth::user();
        if (!$user) return Inertia::render('Friends', ['friends' => [], 'videos' => []]);

        // Get mutual friends for the top bar
        $friends = $user->friends()->get();

        // Try getting videos from mutual friends first
        $friendIds = $friends->pluck('id');
        $videos = Video::whereIn('user_id', $friendIds)
            ->with(['user', 'likes', 'comments'])
            ->withCount(['likes', 'comments'])
            ->latest()
            ->limit(20)
            ->get();

        // Fallback: If no mutual friends have videos, show videos from EVERYONE you follow
        if ($videos->isEmpty()) {
            $followingIds = $user->following()->pluck('users.id');
            $videos = Video::whereIn('user_id', $followingIds)
                ->with(['user', 'likes', 'comments'])
                ->withCount(['likes', 'comments'])
                ->latest()
                ->limit(20)
                ->get();
        }

        $videos = $videos->map(function($video) use ($user) {
            $video->likes_exists = $video->likes->where('user_id', $user->id)->count() > 0;
            return $video;
        });

        return Inertia::render('Friends', [
            'friends' => $friends,
            'videos' => $videos,
        ]);
    }
}
