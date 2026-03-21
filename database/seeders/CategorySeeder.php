<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['All', 'Trending', 'Comedy', 'Education', 'Gaming', 'Music', 'Vlogs', 'Electronics', 'Fashion', 'Beauty', 'Home', 'Toys'];
        
        foreach ($categories as $cat) {
            Category::firstOrCreate(['name' => $cat]);
        }
    }
}
