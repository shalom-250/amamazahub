<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

// Auth Routes
Route::get('/signup', [AuthController::class, 'showSignup']);
Route::post('/signup', [AuthController::class, 'signup']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Profile & Pages
Route::get('/explore', function () {
    return Inertia::render('Explore');
});

Route::get('/upload', function () {
    return Inertia::render('Upload');
});

Route::get('/messages', function () {
    return Inertia::render('Messages');
});

Route::get('/profile', function () {
    return Inertia::render('Profile');
});

use App\Http\Controllers\VideoController;

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit']);
    Route::post('/profile/update', [ProfileController::class, 'update']);
    Route::post('/videos', [VideoController::class, 'store']);
});
