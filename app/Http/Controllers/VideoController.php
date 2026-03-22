<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Comment;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type', 'foryou');

        $query = Video::with('user')
            ->withCount(['likes', 'comments', 'reposts', 'shares', 'bookmarks'])
            ->withExists(['likes' => function ($query) {
                $query->where('user_id', Auth::id());
            }])
            ->withExists(['reposts' => function ($query) {
                $query->where('user_id', Auth::id());
            }])
            ->withExists(['bookmarks' => function ($query) {
                $query->where('user_id', Auth::id());
            }]);

        $query->with(['user' => function ($q) {
            $q->withExists(['followers as is_followed' => function ($f) {
                $f->where('follower_id', Auth::id());
            }]);
        }]);

        if ($type === 'following' && Auth::check()) {
            $followingIds = Auth::user()->following()->pluck('following_id');
            $query->whereIn('user_id', $followingIds);
        }

        if ($type === 'foryou') {
            $user = Auth::user();
            if ($user) {
                $followingIds = $user->following()->pluck('following_id')->toArray();
                $location = $user->location;
                
                $query->join('users', 'videos.user_id', '=', 'users.id')
                    ->select('videos.*')
                    ->addSelect(\DB::raw("
                        (CASE WHEN users.id IN (" . (count($followingIds) ? implode(',', $followingIds) : '0') . ") THEN 2 ELSE 0 END +
                         CASE WHEN users.location = " . \DB::getPdo()->quote($location) . " THEN 1 ELSE 0 END) as score
                    "))
                    ->orderByDesc('score');
            }
            $query->inRandomOrder();
        }

        $videos = $query->paginate(10);

        return Inertia::render('Welcome', [
            'videos' => $videos,
            'feedType' => $type
        ]);
    }

    public function show(Video $video)
    {
        $user = Auth::user();
        $video->load(['user' => function ($q) use ($user) {
            $q->withExists(['followers as is_followed' => function ($f) use ($user) {
                $f->where('follower_id', $user?->id);
            }]);
        }]);

        $video->loadCount(['likes', 'comments', 'reposts', 'shares', 'bookmarks']);
        
        $video->likes_exists = $user ? $video->likes()->where('user_id', $user->id)->exists() : false;
        $video->reposts_exists = $user ? $video->reposts()->where('user_id', $user->id)->exists() : false;
        $video->bookmarks_exists = $user ? $video->bookmarks()->where('user_id', $user->id)->exists() : false;

        // Fetch top-level comments with counts and user like status
        $comments = Comment::where('video_id', $video->id)
            ->whereNull('parent_id')
            ->with(['user'])
            ->withCount(['likes', 'replies'])
            ->latest()
            ->get();

        if ($user) {
            $comments->transform(function ($comment) use ($user) {
                $comment->likes_exists = $comment->likes()->where('user_id', $user->id)->exists();
                return $comment;
            });
        }

        $video->comments = $comments;

        return Inertia::render('VideoDetail', [
            'video' => $video
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,mov,avi,wmv|max:102400',
            'caption' => 'nullable|string|max:255',
            'category' => 'required|string',
        ]);

        $file = $request->file('video');
        $filename = time() . '_' . $file->getClientOriginalName();
        // Ensure directory exists
        if (!file_exists(public_path('uploads/videos'))) {
            @mkdir(public_path('uploads/videos'), 0777, true);
        }

        $file->move(public_path('uploads/videos'), $filename);

        Video::create([
            'user_id' => Auth::id(),
            'video_url' => url('/uploads/videos/' . $filename),
            'thumbnail_url' => url('/images/logo.png'),
            'caption' => $request->caption,
            'category' => $request->category,
            'music_name' => 'Original Sound - ' . Auth::user()->username,
        ]);

        return redirect('/profile');
    }
}
