<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'language' => 'nullable|string|max:10',
            'dark_mode' => 'nullable|boolean',
            'push_notifications' => 'nullable|boolean',
        ]);

        if ($request->has('language')) {
            $user->language = $request->language;
        }

        if ($request->has('dark_mode')) {
            $user->dark_mode = $request->dark_mode;
        }

        if ($request->has('push_notifications')) {
            $user->push_notifications = $request->push_notifications;
        }

        $user->save();

        return back()->with('success', 'Settings updated successfully.');
    }
}
