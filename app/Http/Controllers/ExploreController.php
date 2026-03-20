<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category', 'Trending');
        
        $videos = Video::with('user')
            ->withExists(['likes' => function ($query) {
                $query->where('user_id', Auth::id());
            }])
            ->where('category', $category)
            ->latest()
            ->paginate(12);

        $categories = ['Trending', 'Comedy', 'Education', 'Gaming', 'Music', 'Vlogs'];

        return Inertia::render('Explore', [
            'videos' => $videos,
            'currentCategory' => $category,
            'categories' => $categories
        ]);
    }
}
