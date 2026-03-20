<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type', 'foryou');

        $query = Video::with('user')->withExists(['likes' => function ($query) {
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

        $videos = $query->inRandomOrder()->paginate(10);

        return Inertia::render('Welcome', [
            'videos' => $videos,
            'feedType' => $type
        ]);
    }
}
