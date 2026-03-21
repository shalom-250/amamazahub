<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'original_price',
        'sales',
        'image',
        'category_id',
        'description',
        'colors',
        'rating',
        'reviews_count',
        'is_bestseller',
        'free_shipping',
    ];

    protected $casts = [
        'colors' => 'array',
        'is_bestseller' => 'boolean',
        'free_shipping' => 'boolean',
        'rating' => 'float',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
