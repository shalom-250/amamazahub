<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'id' => 1, 
                'name' => 'Premium Creator Light', 
                'price' => '$45.00', 
                'original_price' => '$89.00',
                'sales' => '2.4k', 
                'image' => 'https://images.pexels.com/photos/190819/pexels-photo-190819.jpeg?auto=compress&cs=tinysrgb&w=800',
                'category_id' => 2,
                'description' => 'The ultimate lighting solution for creators. Professional-grade LED beads, adjustable color temperature (3200K-5600K), and a heavy-duty tripod stand. Perfect for TikTok, YouTube, and live streaming.',
                'colors' => ['Titanium Black', 'Frost White', 'Sunset Orange'],
                'rating' => 4.9,
                'reviews_count' => 1243,
                'is_bestseller' => true,
            ],
            [
                'id' => 2, 
                'name' => 'Amazama Studio Mic', 
                'price' => '$120.00', 
                'original_price' => '$150.00',
                'sales' => '842', 
                'image' => 'https://images.pexels.com/photos/164829/pexels-photo-164829.jpeg?auto=compress&cs=tinysrgb&w=300',
                'category_id' => 2,
                'description' => 'Crisp, clear broadcast quality sound. Condenser microphone perfect for podcasting, voiceovers, and ASMR.',
                'colors' => ['Matte Black', 'Silver'],
                'rating' => 4.8,
                'reviews_count' => 512,
                'is_bestseller' => false,
            ],
            [
                'id' => 3, 
                'name' => 'Vlog Tripod Pro', 
                'price' => '$29.99', 
                'original_price' => null,
                'sales' => '5.1k', 
                'image' => 'https://images.pexels.com/photos/339379/pexels-photo-339379.jpeg?auto=compress&cs=tinysrgb&w=300',
                'category_id' => 2,
                'description' => 'Ultra-portable, highly durable flex tripod. Wrap it anywhere to get the perfect shot.',
                'colors' => ['Black/Red', 'Stealth Black'],
                'rating' => 4.7,
                'reviews_count' => 890,
                'is_bestseller' => true,
            ],
            [
                'id' => 4, 
                'name' => 'RGB Phone Case', 
                'price' => '$15.00', 
                'original_price' => '$25.00',
                'sales' => '10k+', 
                'image' => 'https://images.pexels.com/photos/1474132/pexels-photo-1474132.jpeg?auto=compress&cs=tinysrgb&w=300',
                'category_id' => 2,
                'description' => 'Stand out from the crowd with sound-reactive RGB lighting built directly into your phone case.',
                'colors' => ['Cyber Neon', 'Aqua Blue'],
                'rating' => 4.5,
                'reviews_count' => 3200,
                'is_bestseller' => true,
            ],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(['id' => $p['id']], $p);
        }
    }
}
