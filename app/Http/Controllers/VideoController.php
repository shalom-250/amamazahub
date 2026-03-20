<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'video' => 'required|file|mimetypes:video/mp4,video/quicktime,video/webm|max:20480', // 20MB max
            'caption' => 'nullable|string|max:255',
        ]);

        $path = $request->file('video')->store('public/videos');
        
        $video = Video::create([
            'user_id' => Auth::id(),
            'video_url' => Storage::url($path),
            'caption' => $request->caption,
            'music_name' => 'Original sound - ' . Auth::user()->name,
        ]);

        return redirect('/profile');
    }
}
