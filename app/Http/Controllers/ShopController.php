<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        $categories = Category::all();
        
        return Inertia::render('Shop', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function show(Product $product)
    {
        return Inertia::render('ProductDetail', [
            'product' => $product
        ]);
    }
}
