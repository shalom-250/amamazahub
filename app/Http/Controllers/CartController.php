<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cartItems = $request->user()->cartItems()->with('product')->latest()->get();
        return Inertia::render('Cart', [
            'cartItems' => $cartItems
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'color' => 'nullable|string'
        ]);

        $user = $request->user();

        // Check if item already exists in cart with same product and color
        $cartItem = $user->cartItems()
            ->where('product_id', $validated['product_id'])
            ->where('color', $validated['color'] ?? null)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $validated['quantity']);
        } else {
            $user->cartItems()->create([
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
                'color' => $validated['color'] ?? null
            ]);
        }

        return redirect()->route('cart.index');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        if ($cartItem->user_id !== $request->user()->id) abort(403);

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:99'
        ]);

        $cartItem->update(['quantity' => $validated['quantity']]);
        return redirect()->back();
    }

    public function destroy(Request $request, CartItem $cartItem)
    {
        if ($cartItem->user_id !== $request->user()->id) abort(403);
        $cartItem->delete();
        return redirect()->back();
    }
}
