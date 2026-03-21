<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user();
        
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $user,
                'unread_messages_count' => $user ? \App\Models\Message::where('receiver_id', $user->id)->where('is_read', false)->count() : 0,
            ],
            'suggested_users' => $user 
                ? \App\Models\User::where('id', '!=', $user->id)
                    ->whereDoesntHave('followers', function ($query) use ($user) {
                        $query->where('follower_id', $user->id);
                    })
                    ->limit(5)
                    ->get()
                : \App\Models\User::limit(5)->get(),
        ];
    }
}
