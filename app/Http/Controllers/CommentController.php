<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Video $video)
    {
        $request->validate([
            'comment_text' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'video_id' => $video->id,
            'comment_text' => $request->comment_text,
            'parent_id' => $request->parent_id,
        ]);

        if ($video->user_id !== Auth::id()) {
            \App\Models\Notification::create([
                'user_id' => $video->user_id,
                'sender_id' => Auth::id(),
                'type' => 'comment',
                'reference_id' => $comment->id,
            ]);
        }

        // Only increment top-level comments count for the video if we want to follow TikTok style, 
        // but usually, it's total comments. I'll stick to total.
        $video->increment('comments_count');

        return response()->json([
            'comment' => $comment->load(['user'])->loadCount('likes'),
            'comments_count' => $video->comments_count
        ]);
    }

    public function index(Video $video)
    {
        $user = Auth::user();
        $comments = Comment::where('video_id', $video->id)
            ->whereNull('parent_id')
            ->with(['user'])
            ->withCount(['likes', 'replies'])
            ->latest()
            ->paginate(20);

        if ($user) {
            $comments->getCollection()->transform(function ($comment) use ($user) {
                $comment->likes_exists = $comment->likes()->where('user_id', $user->id)->exists();
                return $comment;
            });
        }

        return $comments;
    }

    public function toggleLike(Comment $comment)
    {
        $user = Auth::user();
        $like = $comment->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $comment->likes()->detach($user->id);
            $liked = false;
        } else {
            $comment->likes()->attach($user->id);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'likes_count' => $comment->likes()->count()
        ]);
    }

    public function replies(Comment $comment)
    {
        $user = Auth::user();
        $replies = $comment->replies()->with('user')->withCount('likes')->latest()->get();

        if ($user) {
            $replies->transform(function ($reply) use ($user) {
                $reply->likes_exists = $reply->likes()->where('user_id', $user->id)->exists();
                return $reply;
            });
        }

        return $replies;
    }
}
