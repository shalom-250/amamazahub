<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $categories = Category::all();

        $query = Product::with(['category', 'seller']);

        if ($user) {
            $followingIds = $user->following()->pluck('following_id')->toArray();
            $location     = $user->location;

            // Weighted score:
            //   +2  → seller is someone you follow
            //   +1  → seller is in your same city/location
            //   max → +3 for both (followed AND local)
            $followList = count($followingIds)
                ? implode(',', $followingIds)
                : '0';

            $query->leftJoin('users as sellers', 'products.seller_id', '=', 'sellers.id')
                ->select('products.*')
                ->addSelect(DB::raw("
                    (CASE WHEN sellers.id IN ({$followList}) THEN 2 ELSE 0 END +
                     CASE WHEN sellers.location = " . DB::getPdo()->quote($location) . " THEN 1 ELSE 0 END) as relevance_score
                "))
                ->orderByDesc('relevance_score')
                ->orderByRaw('RANDOM()'); // shuffle within each tier
        } else {
            $query->orderByRaw('RANDOM()');
        }

        $products = $query->paginate(20);

        return Inertia::render('Shop', [
            'products'   => $products,
            'categories' => $categories,
        ]);
    }

    public function show(Product $product)
    {
        $product->load('seller', 'category');

        return Inertia::render('ProductDetail', [
            'product' => $product,
        ]);
    }
}
