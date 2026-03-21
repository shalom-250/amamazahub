<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\SocialActionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [App\Http\Controllers\VideoController::class, 'index']);
Route::get('/v/{video}', [App\Http\Controllers\VideoController::class, 'show']);

// Auth Routes
Route::get('/signup', [AuthController::class, 'showSignup']);
Route::post('/signup', [AuthController::class, 'signup']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Profile & Pages
Route::get('/explore', [App\Http\Controllers\ExploreController::class, 'index']);

Route::get('/upload', function () {
    return Inertia::render('Upload');
})->middleware('auth');

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->middleware('auth');
Route::get('/profile/@{username}', [App\Http\Controllers\ProfileController::class, 'show']);

Route::get('/messages', function () {
    return Inertia::render('Messages');
});


Route::get('/following', [FollowController::class, 'index'])->name('following');

Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->middleware('auth');

Route::get('/live', function () {
    return Inertia::render('Live');
});

Route::middleware('auth')->group(function () {
    Route::get('/settings', function () {
        return Inertia::render('Settings');
    });

    Route::get('/creator-tools', function () {
        return Inertia::render('CreatorTools');
    });

    Route::get('/wallet', function () {
        return Inertia::render('Wallet');
    });

    // Social Actions
    Route::post('/videos/{video}/like', [\App\Http\Controllers\LikeController::class, 'toggle']);
    Route::post('/videos/{video}/comment', [\App\Http\Controllers\CommentController::class, 'store']);
    Route::get('/videos/{video}/comments', [\App\Http\Controllers\CommentController::class, 'index']);
    Route::post('/videos/{video}/repost', [SocialActionController::class, 'repost']);
    Route::post('/videos/{video}/share', [SocialActionController::class, 'share']);
    Route::post('/videos/{video}/bookmark', [SocialActionController::class, 'bookmark']);
    Route::post('/users/{user}/follow', [\App\Http\Controllers\FollowController::class, 'toggle']);

    Route::get('/help', function () {
        return Inertia::render('HelpCenter');
    });

    Route::get('/friends', [FollowController::class, 'friendsPage']);

    Route::get('/search', function () {
        return Inertia::render('Search');
    });

    Route::get('/shop', [\App\Http\Controllers\ShopController::class, 'index']);
    Route::get('/shop/product/{product}', [\App\Http\Controllers\ShopController::class, 'show']);

    Route::get('/shop/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/shop/cart', [\App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
    Route::put('/shop/cart/{cartItem}', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::delete('/shop/cart/{cartItem}', [\App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/shop/orders', function () {
        return Inertia::render('Orders');
    });

    Route::get('/shop/seller', function () {
        return Inertia::render('SellerCenter');
    });

    Route::get('/shop/addresses', [\App\Http\Controllers\AddressController::class, 'index']);
    Route::post('/shop/addresses', [\App\Http\Controllers\AddressController::class, 'store']);
    Route::put('/shop/addresses/{address}/default', [\App\Http\Controllers\AddressController::class, 'set_default']);
    Route::delete('/shop/addresses/{address}', [\App\Http\Controllers\AddressController::class, 'destroy']);

    Route::get('/shop/payments', [\App\Http\Controllers\PaymentMethodController::class, 'index']);
    Route::post('/shop/payments', [\App\Http\Controllers\PaymentMethodController::class, 'store']);
    Route::put('/shop/payments/{paymentMethod}/default', [\App\Http\Controllers\PaymentMethodController::class, 'set_default']);
    Route::delete('/shop/payments/{paymentMethod}', [\App\Http\Controllers\PaymentMethodController::class, 'destroy']);

    Route::get('/shop/checkout', [\App\Http\Controllers\CheckoutController::class, 'index']);

    Route::get('/shop/promos', function () {
        return Inertia::render('Promotions');
    });

    Route::get('/shop/discovery', function () {
        return Inertia::render('ShopSearch');
    });

    Route::get('/video-detail', function () {
        return Inertia::render('VideoDetail');
    });

    Route::get('/privacy', function () {
        return Inertia::render('Privacy');
    });

    Route::get('/safety', function () {
        return Inertia::render('Safety');
    });

    Route::get('/activity', function () {
        return Inertia::render('Activity');
    });

    Route::get('/guidelines', function () {
        return Inertia::render('Guidelines');
    });

    Route::get('/preferences', function () {
        return Inertia::render('Preferences');
    });

    Route::get('/story', function () {
        return Inertia::render('StoryCreator');
    });

    Route::get('/profile/edit', [ProfileController::class, 'edit']);
    Route::post('/profile/update', [ProfileController::class, 'update']);
    Route::post('/v/upload', [VideoController::class, 'store']);
    
    // Social Features
    Route::post('/users/{user}/follow', [FollowController::class, 'toggle']);
    Route::get('/api/suggested', [FollowController::class, 'suggested']);
    Route::get('/api/following', [FollowController::class, 'following']);
    
    // Messaging
    Route::get('/messages', [MessageController::class, 'index']);
    Route::get('/api/messages/{user}', [MessageController::class, 'getMessages']);
    Route::post('/api/messages/{user}', [MessageController::class, 'store']);
    
    // Video Interactions
    Route::post('/videos/{video}/like', [App\Http\Controllers\LikeController::class, 'toggle']);
    Route::post('/videos/{video}/comment', [App\Http\Controllers\CommentController::class, 'store']);
    Route::get('/videos/{video}/comments', [App\Http\Controllers\CommentController::class, 'index']);
});
