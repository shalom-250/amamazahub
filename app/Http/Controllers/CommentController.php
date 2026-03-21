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
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'video_id' => $video->id,
            'comment_text' => $request->comment_text,
        ]);

        if ($video->user_id !== Auth::id()) {
            \App\Models\Notification::create([
                'user_id' => $video->user_id,
                'sender_id' => Auth::id(),
                'type' => 'comment',
                'reference_id' => $comment->id,
            ]);
        }

        $video->increment('comments_count');

        return response()->json([
            'comment' => $comment->load('user'),
            'comments_count' => $video->comments_count
        ]);
    }

    public function index(Video $video)
    {
        return $video->comments()->with('user')->latest()->paginate(20);
    }
}
