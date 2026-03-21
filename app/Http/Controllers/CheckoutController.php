<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // Get user's default address, fallback to any existing address
        $user = $request->user();
        $address = $user->addresses()->where('isDefault', true)->first() ?? $user->addresses()->first();

        // Get user's default payment method
        $paymentMethod = $user->paymentMethods()->where('isDefault', true)->first() ?? $user->paymentMethods()->first();

        // Get Cart Items
        $cartItems = $user->cartItems()->with('product')->get();
        $subtotal = $cartItems->sum(function($item) {
            $price = (float) preg_replace('/[^0-9.]/', '', $item->product->price);
            return $item->quantity * $price;
        });

        return Inertia::render('Checkout', [
            'defaultAddress' => $address,
            'defaultPayment' => $paymentMethod,
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'user' => $user
        ]);
    }
}
