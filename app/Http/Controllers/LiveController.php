<?php

namespace App\Http\Controllers;

use App\Models\LiveSession;
use App\Models\LiveMessage;
use App\Models\LiveLike;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class LiveController extends Controller
{
    public function index()
    {
        $sessions = LiveSession::where('status', 'live')
            ->with('user')
            ->latest()
            ->get();

        return Inertia::render('Live', [
            'sessions' => $sessions
        ]);
    }

    public function create()
    {
        return Inertia::render('Live/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
        ]);

        $session = LiveSession::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'live',
            'thumbnail_url' => 'https://images.pexels.com/photos/257904/pexels-photo-257904.jpeg?auto=compress&cs=tinysrgb&w=800', // Default placeholder
        ]);

        return redirect()->route('live.show', $session->id);
    }

    public function show(LiveSession $session)
    {
        $isHost = auth()->id() === $session->user_id;

        if (!$isHost) {
            $session->increment('viewers_count');
        }

        $session->load('user');
        
        $messages = LiveMessage::where('live_session_id', $session->id)
            ->with('user')
            ->latest()
            ->limit(30)
            ->get()
            ->reverse()
            ->values();

        $likeCount = LiveLike::where('live_session_id', $session->id)->count();
        $isLiked = LiveLike::where('live_session_id', $session->id)
            ->where('user_id', auth()->id())
            ->exists();

        return Inertia::render('Live/Stream', [
            'session' => $session,
            'isHost' => $isHost,
            'initialMessages' => $messages,
            'initialLikeCount' => $likeCount,
            'initialIsLiked' => $isLiked
        ]);
    }

    public function sendMessage(Request $request, LiveSession $session)
    {
        $request->validate(['message' => 'required|string|max:500']);

        $message = LiveMessage::create([
            'live_session_id' => $session->id,
            'user_id' => auth()->id(),
            'message' => $request->message
        ]);

        return response()->json($message->load('user'));
    }

    public function toggleLike(LiveSession $session)
    {
        $like = LiveLike::where('live_session_id', $session->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            LiveLike::create([
                'live_session_id' => $session->id,
                'user_id' => auth()->id()
            ]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'count' => LiveLike::where('live_session_id', $session->id)->count()
        ]);
    }

    public function sync(LiveSession $session)
    {
        $messages = LiveMessage::where('live_session_id', $session->id)
            ->with('user')
            ->where('created_at', '>', now()->subSeconds(10))
            ->latest()
            ->get();

        return response()->json([
            'viewers' => $session->viewers_count,
            'likes' => LiveLike::where('live_session_id', $session->id)->count(),
            'newMessages' => $messages
        ]);
    }

    public function end(LiveSession $session)
    {
        if (auth()->id() !== $session->user_id) {
            abort(403);
        }

        $session->update(['status' => 'ended']);

        return redirect()->route('live.index');
    }
}
