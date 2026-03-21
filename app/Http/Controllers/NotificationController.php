<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Fetch notifications for the authenticated user, load the sender details
        $notifications = $user->notifications()
            ->with('sender')
            ->latest()
            ->paginate(50);
            
        // Mark as read (optional logic, mark all as read when page is visited)
        $user->notifications()->whereNull('read_at')->update(['read_at' => now()]);

        return Inertia::render('Notifications', [
            'notifications' => $notifications
        ]);
    }
}
