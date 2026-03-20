<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Get unique users involved in conversations with the current user
        $conversations = User::whereIn('id', function($query) use ($userId) {
            $query->select('sender_id')
                ->from('messages')
                ->where('receiver_id', $userId)
                ->union(
                    DB::table('messages')
                        ->select('receiver_id')
                        ->where('sender_id', $userId)
                );
        })->get()->map(function($user) use ($userId) {
            $lastMessage = Message::where(function($q) use ($userId, $user) {
                $q->where('sender_id', $userId)->where('receiver_id', $user->id);
            })->orWhere(function($q) use ($userId, $user) {
                $q->where('sender_id', $user->id)->where('receiver_id', $userId);
            })->latest()->first();

            return [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'avatar' => $user->avatar,
                'last_message' => $lastMessage ? $lastMessage->message : '',
                'last_message_time' => $lastMessage ? $lastMessage->created_at->diffForHumans() : '',
            ];
        });

        return Inertia::render('Messages', [
            'conversations' => $conversations,
        ]);
    }

    public function getMessages(User $user)
    {
        $userId = Auth::id();

        $messages = Message::where(function($q) use ($userId, $user) {
                $q->where('sender_id', $userId)->where('receiver_id', $user->id);
            })
            ->orWhere(function($q) use ($userId, $user) {
                $q->where('sender_id', $user->id)->where('receiver_id', $userId);
            })
            ->oldest()
            ->get();

        return response()->json($messages);
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'message' => $request->message,
        ]);

        return response()->json($message);
    }
}
